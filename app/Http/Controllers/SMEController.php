<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\SME;
use App\Http\Models\Survey;
use App\Http\Models\SurveyResult;

class SMEController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function saveresult(Request $request){
        
        \Log::info('SMECONTR - SAVERESULTS');
        $user = \Auth::user();
        $result = new SurveyResult();
        $result->user_id = $user->id;
        $result->survey_id = $request['numberofoursurvey'];
        $result->json = $request['datacontaininganswers'];
        $result->save();
        return response()->json(['success'=> trans('surveys.successmessage')]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
     // if(izraz)  to provjerava jel izraz true or false npr. if ($x)  ili if($x<5)   ili if ($x<5 & $y>3)
        $user = \Auth::user(); 
        $sme = SME::where('user_id', $user->id)->first();
        if ($sme != null) { //if($sme == $user) je uvijek false jedan je AUTH a drugi SME. if ($sme->user_id...) ima problem ako je sme null jer trazimo property od null koji ne postoji
            return view('profileedit', compact('sme'));
        } else {
            return view('profileadd');
        }       
    }


    public function home()
    {
        $surveys = Survey::where('anonymous', 0)->get();
        return view('home', compact('surveys'));
    }

    public function takesurvey($id)
    {  
        $survey = Survey::find($id);
        return view('takesurvey',compact('survey'));
    }

    // graph display
    public function graph($id)
    {       
     //ek- get id from selected survey
        $survey = Survey::find($id);
     //ek- get user id   
        $user = \Auth::user()-> id;  //Esther=15

         //ek- get all survey_results that match selected survey id
        $results = SurveyResult::where('survey_id',$id)->get();
         //ek- match userid
        $userresults = $results -> where ('user_id',$user)->last();
         //ek- get json fom user survey        
        $decodeusersurvey = json_decode($userresults->json);
        $useranswers = $decodeusersurvey;
            
         //ek- get json fom these survey
        $decodesurvey = json_decode($survey->json);
        $pages = $decodesurvey -> pages;
         //ek- for every type in json check type
         $maturitycounter = 0;
         $maturitysum = 0;
         $countradiogroup=0;
         $countrating=0;
        foreach ($pages as $page)
        { 
            if (!property_exists($page, "elements")) {
                continue;
            }
            $elements = $page->elements;
            //dd($elements);
            foreach ($elements as $element)
            {             
                $type = $element->type;
             //ek- get question name
                $name = $element->name;

                if (property_exists($element, "commentText")) 
                {
                    if($element->commentText == 'GRAPH')
                    { 
                        //dd($element);
                        switch($type)
                        {
                            //ek- case "html":
                            //ek-     echo "type is html\n";
                            //ek-     break;
                            case "radiogroup":
                                $countradiogroup = $countradiogroup +1;
                                $tempdata = $this->radiogroup($element, $results, $useranswers,$name, $type);
                             
                                if($tempdata != null && sizeof($tempdata) > 2) {
                                    $maturitycounter = $maturitycounter + 1;
                                    $maturitysum = $maturitysum + $tempdata[2];
                                }          
                                $data[] = $tempdata;
                                break;
                            case "rating":
                                $countrating = $countrating +1;
                                $data[] = $this->rating($element, $results, $useranswers, $name, $type);
                                break;
                            default:
                                break;
                        }
                    }
 
                }
            }
        }
        
        if($countrating == 0 && $countradiogroup == 0){
            return redirect('/home')->withErrors(notific8(trans('surveys.nograph')));  
        }else{
            if ($maturitycounter != 0) {
                $average = $maturitysum/$maturitycounter;
            } else {
                $average = 0;
            }
            return view('takesurveyresults', compact('data', 'average', 'survey'));
        }

    }
    
    public function rating($element, $results, $useranswers, $name, $type){ 
        //ek- dd($element, $results, $useranswers, $name, $type);

        $rate_values = 0;
        //ek- Check if $element->rateValues exist
        if(isset($element->rateValues))
        {
            $rate_values= array();
            for ($i=0; $i < sizeof($element->rateValues); $i++){
                    $tempobject1 = new \stdClass();
                    if(isset($rateValues->value)){
                            $tempobject1->value = $rateValues->value;
                        }else{
                            $tempobject1->value = $i+1;
                        }
                    if(isset($rateValues->text)){
                            $tempobject1->text = $rateValues->value;
                        }else{
                            $tempobject1->text = "";;
                        }
                 $rate_values[] = $tempobject1;   
            }

            //$rate_values = $element-> rateValues;

        } else{
            //ek- Check if $element->ratemax exist
            if(isset($element->rateMax))
            {
                $Ratemax = $element->rateMax;
            }else{
                $Ratemax = 105;
            }
           //ek- dd($Ratemax);
           $rate_values= array();
            for ($i=0; $i < $Ratemax; $i++){
                    $tempobject2 = new \stdClass();
                    $tempobject2->value = $i+1;
                    $tempobject2->text = "";
                 $rate_values[] = $tempobject2;   
            }
        }
        //ek- dd($rate_values);
        $answers_array = array();
        $counter_array = array();
       
        foreach ($rate_values as $rate_value){
            //ek- check if value exists
            if(isset($rate_value -> value)){
                $answers_array[$rate_value -> value] = $rate_value -> text;
            }else{
                $answers_array[$rate_value -> value] = "";
            }
            //ek- check if texts exists            
           if(isset($rate_value -> text)){ 
                $counter_array[$rate_value -> value] = 0;
           }else{
               $answers_array[$rate_value -> value] = "";
           }
        }
       //ek-  dd($counter_array);
       //ek-  dd( $results, $useranswers);
        foreach ($results as $result){
            $answers = json_decode($result->json);
            //dd($answers, $name);
            if (property_exists($answers, $name)) {
                if ($answers->$name !="other")  { 
                    $counter_array[$answers->$name] ++;
                }
            }
        } 
       //ek-  var_dump($answers_array, $counter_array);

        $divideby = array_sum($counter_array);

        $sum = 0;
        foreach ($counter_array as $key => $value) {
            $sum = $sum + ($value * $key);
        }
        if ($divideby != 0) {
            $average = $sum/$divideby;
        } else {
            $average = 0;
        }
        if (property_exists($useranswers, $name)) {
                $r = $useranswers->$name;
            }else{
                $r =0;
            }
        return ([$name, $average, $r]);
    }
    public function radiogroup($element, $results, $useranswers, $name, $type){ 
    
    //i need to calculate the average answer from all users to specific question
    //this function needs to return, name of the question, average score and user's score.

    //textual users answer
    if(property_exists($useranswers,$name)){
        $textuseranswer = $useranswers->$name;
    }else{
        return;
    }
    
    //we need to convert to number

    $numericaluseranswer = 0;
    $tempcounter = 1;
    if(isset($element->choices)) {
        foreach ($element->choices as $ec) {
            if (property_exists($ec, 'value') && $ec->value == $textuseranswer) {
                $numericaluseranswer = $tempcounter;
            }else if ($ec == $textuseranswer) {
                $numericaluseranswer = $tempcounter;
            }
            $tempcounter = $tempcounter +1;
        }
    }
    // i need the average, so I need to go though all the answers of all users,
    // give them numberical value, 1,3,2,2,3,1  add those, and divide by number of answers i.e. 6
    
    //since i have all answers for the survey in json format i need to decode and extract
    $sum = 0;
    $counter = 0;
    foreach ($results as $result) {
        $tempuseranswers = json_decode($result->json);
        if(property_exists($tempuseranswers,$name)){
            $tempusertextanswer = $tempuseranswers->$name;
        }else{
            continue;
        }
        $tempnumericaluseranswer = 0;
        $tempcounter = 1;

        if(isset($element->choices)) {
            foreach ($element->choices as $ec) {
                if (property_exists($ec, 'value') && $ec->value == $tempusertextanswer) {
                    $tempnumericaluseranswer = $tempcounter;
                }else if ($ec == $tempusertextanswer) {
                    $tempnumericaluseranswer = $tempcounter;
                }
                $tempcounter = $tempcounter +1;
            }
        }
        if ($tempnumericaluseranswer != 0) {
            $sum = $sum + $tempnumericaluseranswer;
            $counter = $counter + 1;
        }
    }
    if ($counter != 0) {
        $average = $sum/$counter;
    } else {
        $average = 0;
    }
    
    return ([$name, $average, $numericaluseranswer]);
    }

    //edit existing sme
    public function editsave(Request $request, $id)
    {
        $validatedData = $request->validate([
        ]);
        $sme = SME::find($id);
        $sme->company_name = request('company_name');
        $sme->address1 = request('address1');
        $sme->address2 = request('address2');
        $sme->postcode = request('postcode');
        $sme->town = request('town');
        $sme->country = request('country');
        $sme->role = request('role');
        $sme->establishment= request('establishment');
        $sme->province = request('province');
        $sme->active = request('active');
        $sme->legal = request('legal');
        $sme->legal_other = request('legalother');
        $sme->sector = request('sector');
        $sme->sector_other = request('sectorother');
        $sme->exist = request('exist');
        $sme->size = request('size');
        $sme->turnover = request('turnover'); 
        $sme->supply = request('supply');
        $sme->supply_other = request('supplyother');
        $sme->it = request('it');
        $sme->it_other = request('itother');
        $sme->short_description = request('short_description');
        $sme->save();
        return redirect('home')->withErrors(notific8(trans('surveys.smesaved')));
    }    

    public function addsave(Request $request)
    {
        $validatedData = $request->validate([
        ]);
        $sme = new SME;
        $sme->user_id = \Auth::user()->id;
        $sme->company_name = request('company_name');
        $sme->address1 = request('address1');
        $sme->address2 = request('address2');
        $sme->postcode = request('postcode');
        $sme->town = request('town');
        $sme->country = request('country');
        $sme->role = request('role');
        $sme->establishment= request('establishment');
        $sme->province = request('province');
        $sme->active = request('active');
        $sme->legal = request('legal');
        $sme->legal_other = request('legalother');
        $sme->sector = request('sector');
        $sme->sector_other = request('sectorother');
        $sme->exist = request('exist');
        $sme->size = request('size');
        $sme->turnover = request('turnover'); 
        $sme->supply = request('supply');
        $sme->supply_other = request('supplyother');
        $sme->it = request('it');
        $sme->it_other = request('itother');
        $sme->short_description = request('short_description');
        $sme->save();
        return redirect('home')->withErrors(notific8(trans('surveys.smesaved')));
    }

    //save email entered at takesurveyresults graph
    public function emailsave(Request $request)
    {
        $validatedData = $request->validate([
        ]);
        $email->email = request('email');
        $email->save();
        return redirect('home')->withErrors(notific8(trans('surveys.emailsaved')));
    }    
}

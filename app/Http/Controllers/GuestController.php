<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\SME;
use App\Http\Models\Survey;
use App\Http\Models\SurveyResult;
use App\Http\Models\Email;

class GuestController extends Controller
{

   public function __construct() {
    }
    public function takeanonymus($id){  
        $survey = Survey::find($id);
        return view('takeanonymoussurvey',compact('survey'));
    }

    public function saveanonymousresult(Request $request){
         \Log::info('in save rs');
        $result = new SurveyResult();
        $result->user_id = 0;
         \Log::info($result->user_id);
        $result->survey_id = $request['numberofoursurvey'];
        $result->json = $request['datacontaininganswers'];
        $result->save();
        return response()->json(['success'=> trans('surveys.successmessage')]);
    }

    // graph display
    public function graphanonymous($id){    
         \Log::info('in graph');   
            $survey = Survey::find($id); 
            $user = 0;
            $results = SurveyResult::where('survey_id',$id)->get();
            $userresults = $results -> where ('user_id',$user)->last();     
            $decodeusersurvey = json_decode($userresults->json);
            $useranswers = $decodeusersurvey;
            
            $decodesurvey = json_decode($survey->json);
            $pages = $decodesurvey -> pages;
            $maturitycounter = 0;
            $maturitysum = 0;
            $countradiogroup=0;
            $countrating=0;
           // 
            foreach ($pages as $page){ 
                if (!property_exists($page, "elements")) {
                    continue;
                }
                $elements = $page->elements;
                foreach ($elements as $element){ 
                    $type = $element->type;
                    $name = $element->name;

                    if (property_exists($element, "commentText")) 
                {
                    if($element->commentText == 'GRAPH')
                    {
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
            return view('takeanonymousresults', compact('data', 'average'));
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


    public function emailsave(Request $request)
    {
        $validatedData = $request->validate([
              'email' => 'email',
        ]);
        $email = new Email();
        $email->emails = request('email');
        $email->save();
        return redirect('home')->withErrors(notific8(trans('surveys.emailsaved')));
    }    
    
 }
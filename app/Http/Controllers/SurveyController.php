<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Survey;
use App\Http\Models\SurveyResult;
use App\Http\Models\SME;

class SurveyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('\App\Http\Middleware\Administrator');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function newsurvey(Request $request)
    {
        $language=\Session::get('locale', \Config::get('app.locale'));
        $name = request('surveyname');
        $published_at = request('surveypublished_at');
        $anonymous = request('anonymous');
        if ($anonymous == null) {
            $anonymous = 0;
        } else {
            $anonymous = 1;
        };
        $no_email = request('no_email');
        if ($no_email == null) {
            $no_email = 0;
        } else {
            $no_email = 1;
        };
        return view('newsurvey', compact('name', 'published_at', 'language', 'anonymous', 'no_email'));
    }

    public function surveys()
    {
        $surveys = Survey::all();
        return view('surveys', compact('surveys'));
    }

    public function save(Request $request)
    {
       //we need to check if the survey exist in the table. If exists then we have to update it, otherwise create new one
       // $request['surveyname'] is for example = test5

       $survey = Survey::where('name',$request['surveyname'])->first();
       if ($survey == null)
       {
        $survey = new Survey();
        $survey->name = $request['surveyname'];
        $survey->slug = $request['surveyname'] . "-1";
        $json = $request['surveyjson'];
        $json = json_decode($json, true);
        if(empty($json["pagePrevText"]))
        {
            $json["pagePrevText"]= trans('surveys.pagePrevText');
        }
        if(empty($json["pageNextText"]))
        {
            $json["pageNextText"] = trans('surveys.pageNextText');

        }
        if(empty($json["completeText"]))
        {   $survey->anonymous = $request['anonymous'];
            $survey->no_email = $request['no_email'];
            $json["completeText"] = trans('surveys.completeText');

        }
       
        $json = json_encode($json);
        $survey->json = $json;
        $survey->published_at = $request['surveypublished_at'];
        $survey->anonymous = $request['anonymous'];
        //dd($no_email);
        $survey->no_email= $request['no_email'];
        $survey->save();

       }
       else {
  
        $json = $request['surveyjson'];
        $json = json_decode($json, true);
        if(empty($json["pagePrevText"]))
        {
            $json["pagePrevText"]= trans('surveys.pagePrevText');
        }
        if(empty($json["pageNextText"]))
        {
            $json["pageNextText"] = trans('surveys.pageNextText');

        }
        if(empty($json["completeText"]))
        {
            $json["completeText"] = trans('surveys.completeText');

        }
        $json = json_encode($json);
        $survey->published_at = $request['surveypublished_at'];
        $survey->anonymous = $request['anonymous'];
        $survey->no_email= $request['no_email'];
        $survey->json = $json;
        $survey->save();

    }
    
        return response()->json(['success'=> trans('surveys.successmessage')]);
    }

    public function editsurvey($id)
    {

        $language=\Session::get('locale', \Config::get('app.locale'));
        //retrieve data from table surveys, we only need one survey data
        //To retrieve a single row by its id column value, use the find method:
        $survey = Survey::find($id);
        $anonymous = $survey->anonymous;
        $no_email = $survey->no_email;
        //view required survey for editing in the editsurvey.blade
        return view('editsurvey',compact('survey', 'language', 'anonymous', 'no_email'));
        //we will need to use compact function from PHP
        //first parameter is name of the view, from laravel,  second part is from php compact function, but var is not using $ sign
    }


    public function changedateandname (Request $request, $id)
    {  
        $survey = Survey::find($id);  //search on survey-id instead of survey-name
         if ($survey != null)
        {
        //we want to change survey's name and publish date
            //find the survey we need to change
            $survey = Survey::find($id);
            //we need to change the name
            $survey->name = $request['surveyname'];
            $survey->slug = $request['surveyname'] . "-1";
            //we need to change the date
            $survey->published_at = $request['surveypublished_at'];
            // we need to save the changes
            $anonymous = request('anonymous');
            if ($anonymous == null) {
                $anonymous = 0;
            } else {
                $anonymous = 1;
            }
            $survey->anonymous = $anonymous;
            //dd($anonymous);
            $no_email = request('no_email');
            if ($no_email == null) {
                $no_email = 0;
            } else {
                $no_email = 1;
            }
            $survey->no_email = $no_email;
            $survey->save();
            // we need to send the mesage 
            //dd($survey->id, $survey->name, $survey->published_at, $survey->anonymous, $survey->no_email);
            return redirect('surveys')->withErrors(notific8(trans('surveys.surveychanged')));
        }
    }

    public function duplicate (Request $request, $id)
    {  
        //dd($request);
      //create new survey with json from "original"
        $survey = new Survey();
        //take name from form
        $survey->name = $request['surveyname'];
        $survey->slug = $request['surveyname'] . "-1";
        //get "selected" survey
        $surveyselected = Survey::find($id);
        //check if "selected" survey is a duplicate
        if($surveyselected->duplicate == null){
            $survey->duplicate = $surveyselected->id;
        } else {
            $survey->duplicate = $surveyselected->duplicate;
        }
        //copy json from "selected" survey
        $json = $surveyselected-> json;
        $survey->json = $json;
         //take publishing date from form
        $survey->published_at = $request['surveypublished_at'];
        $anonymous = request('anonymous');
        if ($anonymous == null) {
            $anonymous = 0;
        } else {
            $anonymous = 1;
        }
        $survey->anonymous = $anonymous;
        //dd($anonymous);
        $no_email = request('no_email');
        if ($no_email == null) {
            $no_email = 0;
        } else {
            $no_email = 1;
        }
        $survey->no_email = $no_email;

        $survey->save();

        return redirect('surveys')->withErrors(notific8(trans('surveys.surveyduplicated')));
    }


    public function delete($id)
    {
        \DB::table('surveys')->delete($id);
        return redirect()->back()->withErrors(notific8(trans('surveys.surveydeleted')));
    }


    public function showSMEs()
    {
        $smes = SME::all();
        return view('smes', compact('smes'));
    }

    public function addsme()
    {
        return view('addsme');
    }

    public function editsme($id)
    {
        $sme = SME::find($id);
        return view('editsme', compact('sme'));
    }

    //edit existing sme
    public function editsave(Request $request, $id)
    {
        $validatedData = $request->validate([
            // 'established_year' => 'integer',
            // 'number_employees' => 'integer',
            //'turnover' => 'integer',
        ]);
        $sme = SME::find($id);
        $sme->company_name = request('company_name');
        $sme->address1 = request('address1');
        $sme->address2 = request('address2');
        $sme->postcode = request('postcode');
        $sme->town = request('town');
        $sme->country = request('country');
        $sme->role = request('role');
        $sme->role_other = request('roleother');
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
        return redirect('smes')->withErrors(notific8(trans('surveys.smesaved')));
    }    

    public function addsave(Request $request)
    {
        $validatedData = $request->validate([
            //'turnover' => 'integer',
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
        $sme->role_other = request('roleother');
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
        return redirect('smes')->withErrors(notific8(trans('surveys.smesaved')));
    }


    public function info($id)
    {
        $sme = SME::find($id);
        $user = $sme->user_id;
        $surveylist = Survey::all();
        $surveyCount = $surveylist->count();

        $smesurveys = SurveyResult::where('user_id',$user)->get();
        $surveysTaken = $smesurveys->count();
   
        $surveysOpen = $surveyCount - $surveysTaken;
     
        foreach ($smesurveys as $smesurvey)
        {
            //dd($smesurveys, $surveylist);
            // filling dropdown at infosme.blade
            //dd($smesurvey->survey_id, $surveylist);
            $name = $surveylist->where('id', $smesurvey->survey_id)->first()->name;
            $smesurvey->dropname = $name;
        }
        return view('infosme', compact('sme', 'smesurveys', 'surveyCount', 'surveysTaken', 'surveysOpen'));
    }

    public function infodata($selectedid)
    {
        // //get data sme
        // $sme = SME::find($id);//$sme_id
        // //get userid from selected sme
        // $user = $sme->user_id;
        // //get selected survey
        //$survey = Survey::find($survey_id); //$survey_id - id = 4
        //- get all survey_results that match selected survey id
        //$results = SurveyResult::where('survey_id',$survey_id)->get();
        // // //match userid
        // $smeresults = $results -> where ('user_id',$user)->last();
        // // //- get json fom user survey  
        // $smejsons = json_decode($smeresults->json);

        //return $smejsons;

        $survey = SurveyResult::where('id',$selectedid)->first();
        $surveyjsons = $survey->json;
    
        return $surveyjsons;
    }

    public function view()
    {
        return view('viewsme', compact(''));
    }

    public function deletesme($id)
    {
        $sme = SME::find($id);
        $sme->delete();
        return redirect('smes')->withErrors(notific8(trans('surveys.smedeleted')));
    }

}

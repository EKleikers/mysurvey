<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Report;
use App\Http\Models\SME;
use App\Http\Models\Survey;
use App\Http\Models\SurveyResult;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
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
    public function index()
    {
        //if user is Admin return view is landing page with Surveys, MKBs and Reports links
        //if user is SME   return view is landing page  with list of surveys and profile page link
        $reports = Report::all();
        return view('reports', compact('reports'));
    }


    public function editreport($id)
    {
        //only select none anonymous surveys
        $surveys = Survey::where('anonymous', 0)->get();
        $report = Report::find($id);
        return view('editreport', compact('report', 'surveys'));
    }

    public function saveeditedreport(Request $request, $id)
    {
        $report = Report::find($id);
        $report->report_name = request('reportname');
        $report->survey_select = request('survey_select');
        $report->national_international = request('national_international');
        $report->legal_form = request('legal_form');
        $report->business_sector = request('business_sector');
        $report->time_existence = request('time_existence');
        $report->number_employees = request('number_employees');
        $report->company_turnover = request('company_turnover');
        $report->sales_market = request('sales_market');
        $report->it_arrangement = request('it_arrangement');
        $report->save();
        
        $reports = Report::all();
        return redirect('reports')->withErrors(notific8(trans('surveys.reportchanged')));
    }

    public function edit($id)
    {
        $app = \DB::table('reports')->find($id);
        return view('editreport', compact('app'));
    }

    public function viewreport($id)
    {
        $report = Report::find($id);
        $survey = Survey::find($report->survey_select);
        $decodesurvey = json_decode($survey->json);
        $pages = $decodesurvey->pages;
        $choices = [];
        foreach ($pages as $page) {
            if (!property_exists($page, "elements")) {
                continue;
            }
            $elements = $page->elements;
            foreach ($elements as $element) {
                if (property_exists($element, 'title')) {

                    $questions[$element->name] = $element->title;
                } else {
                    $questions[$element->name] = $element->name;
                }
                if (property_exists($element, 'choices')) {
                    foreach ($element->choices as $elch) {
                        $choices[$element->name][$elch->value] = $elch->text;
                    }
                }
                if (property_exists($element, 'rateValues')) {
                    foreach ($element->rateValues as $elch) {
                        $rateValues[$element->name][$elch->value] = $elch->text;
                    }
                }
            }
        }

        //get surveyresults - answers
        $results = SurveyResult::where('survey_id', $report->survey_select)->get();
        $answers=[];
        foreach ($results as $result) {
            $tempanswer = json_decode($result->json);
            $tempanswer->user_id = $result->user_id;
            // we need to filter out smes which are not to be included in the report
            $user_id = $result->user_id;
            $sme = SME::where('user_id', $user_id)->first();
            if ($sme != null) {
                // filter national_international
                if ($report->national_international != 0) {
                    if ($report->national_international != $sme->active) {
                        continue;
                    }
                }
                // filter legal_form
                if ($report->legal_form != 0) {
                    if ($report->legal_form != $sme->legal) {
                        continue;
                    }
                }
                // filter business_sector
                if ($report->business_sector != 0) {
                    if ($report->business_sector != $sme->sector) {
                        continue;
                    }
                }
                // filter time_existence
                if ($report->time_existence != 0) {
                    if ($report->time_existence != $sme->exist) {
                        continue;
                    }
                }
                // filter number_employees
                if ($report->number_employees != 0) {
                    if ($report->number_employees != $sme->size) {
                        continue;
                    }
                }
                // filter company_turnover
                if ($report->company_turnover != 0) {
                    if ($report->company_turnover != $sme->turnover) {
                        continue;
                    }
                }
                // filter sales_market
                if ($report->sales_market != 0) {
                    if ($report->sales_market != $sme->supply) {
                        continue;
                    }
                }
                // filter it_arrangement
                if ($report->it_arrangement != 0) {
                    if ($report->it_arrangement != $sme->it) {
                        continue;
                    }
                }

                //dd($sme, $report);
                $answers[] = $tempanswer; //json_decode($result->json); 
            }
        }
        return view('surveyresults', compact('result', 'questions', 'answers', 'choices', 'rateValues'));
        //return view('viewreport', compact('report'));
    }

    public function deletereport($id)
    {
        $report = Report::find($id);
        $report->delete();

        return back()->withErrors(notific8(trans('surveys.reportdeleted')));
    }

    public function addnewreport()
    {
        //remove anonymous surveys from dropdown
        $surveys = Survey::where('anonymous', 0)->get();

        return view('addnewreport', compact('surveys'));
    }

    public function savenewreport(Request $request)
    {
        $report = new Report;
        $report->report_name = request('report_name');
        $report->survey_select = request('survey_select');
        $report->national_international = request('national_international');
        $report->legal_form = request('legal_form');
        $report->business_sector = request('business_sector');
        $report->time_existence = request('time_existence');
        $report->number_employees = request('number_employees');
        $report->company_turnover = request('company_turnover');
        $report->sales_market = request('sales_market');
        $report->it_arrangement = request('it_arrangement');
        $report->save();
  
        return redirect('reports')->withErrors(notific8(trans('surveys.reportcreated')));
    }

    public function reportdata($id)
    {

        $report = Report::find($id);
        $survey = Survey::find($report->survey_select);

        $results = SurveyResult::where('survey_id', $report->survey_select)->get()->toArray();
        //dd($report, $results);
        $x = $results;
        $counter = 0;
        foreach ($results as $result) {
            $userid = $result["user_id"];

            $sme = SME::where('user_id', $userid)->first();

            if ($report->national_international != 0 && $report->national_international != $sme->national_international) {
                unset($results[$counter]);
                continue;
            }
            if ($report->legal_form != 0 && $report->legal_form != $sme->legal_form) {
                unset($results[$counter]);
                continue;
            }
            if ($report->business_sector != 0 && $report->business_sector != $sme->business_sector) {
                unset($results[$counter]);
                continue;
            }
            if ($report->time_existence != 0 && $report->time_existence != $sme->time_existence) {
                unset($results[$counter]);
                continue;
            }
            if ($report->number_employees != 0 && $report->number_employees != $sme->number_employees) {
                unset($results[$counter]);
                continue;
            }
            if ($report->company_turnover != 0 && $report->company_turnover != $sme->company_turnover) {
                unset($results[$counter]);
                continue;
            }
            if ($report->sales_market != 0 && $report->sales_market != $sme->sales_market) {
                unset($results[$counter]);
                continue;
            }
            if ($report->it_arrangement != 0 && $report->it_arrangement != $sme->it_arrangement) {
                unset($results[$counter]);
                continue;
            }
            $counter++;
        }
        //dd($report, $x, $results);

        $decodesur = json_decode($survey->json);
        $pages = $decodesur->pages;
        //dd($pages);
        foreach ($pages as $page) {
            foreach ($page->elements as $p) {
                //dd($page->elements, $p->title);
                if (property_exists($p, "title")) {
                    $questions[$p->name] = $p->title;
                } else {
                    $questions[$p->name] = "";
                }
            }
        }
        $answers = array();
        foreach ($results as $result) {

            $tempanswers = json_decode($result["json"]);
            //dd($tempanswers);
            $answers[] = json_decode($result["json"]);
        }
        return view('surveyresults', compact('result', 'questions', 'answers'));
    }

    public function getdata($id)
    {
        //update: multiple pages not working

        //get survey - questions
        $survey = Survey::find($id);
        $decodesurvey = json_decode($survey->json);
        $pages = $decodesurvey->pages;
        $rateValues= Array();
        $choices = [];
        foreach ($pages as $page) {
            if (!property_exists($page, "elements")) {
                continue;
            }
            //elements are the questions
            $elements = $page->elements;

            foreach ($elements as $element) {

                if (property_exists($element, 'title')) {

                    $questions[$element->name] = $element->title;
                } else {
                    $questions[$element->name] = $element->name;
                }
                if (property_exists($element, 'choices')) {
                    foreach ($element->choices as $elch) {
                        if (property_exists($elch, 'value')) {
                            $choices[$element->name][$elch->value] = $elch->text;
                        } else {
                            $choices[$element->name][$elch] = $elch;
                        }
                    }
                }
                if (property_exists($element, 'rateValues')) {
                    foreach ($element->rateValues as $elch) {
                        $rateValues[$element->name][$elch->value] = $elch->text;
                    }
                }
                if (property_exists($element, 'columns')) {
                    foreach ($element->columns as $elch) {
                        $columns[$element->name][$elch->value] = $elch->text;
                    }
                }else{
                    $columns[$element->name] = 'x';
                }
                if (property_exists($element, 'rows')) {
                    foreach ($element->rows as $elch) {
                        $rows[$element->name][$elch->value] = $elch->text;
                    }
                }else{
                    $rows[$element->name] = 'x';
                }
            }
        }

        //get surveyresults - answers
        $results = SurveyResult::where('survey_id', $id)->get();
        foreach ($results as $result) {
            $tempanswer = json_decode($result->json);
            $tempanswer->user_id = $result->user_id;

            $answers[] = $tempanswer; //json_decode($result->json); 
        }
        //FILLING SURVEYRESULTS BLADE
        // dd($result, $questions, $answers, $choices, $rateValues, $columns, $rows);
        return view('surveyresults', compact('result', 'questions', 'answers', 'choices', 'rateValues', 'columns', 'rows'));
    }
}

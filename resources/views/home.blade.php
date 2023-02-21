<?php

use Illuminate\Http\Request;
use App\Http\Models\Survey;
use App\Http\Models\SurveyResult;


$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/home";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.home');
?>
@extends('layouts.app', ['selected' => 'home'])

@section('content')
<?php
$user = \Auth::user();
$sme = \App\Http\Models\SME::where('user_id', $user->id)->first();
if ($sme == null) {
?>
<div class="m-heading-1 border-green m-bordered">
    <h3>{{ trans('surveys.profile') }}</h3>
    <p>{{ trans('surveys.completeprofile') }} <a href="/mysurvey/profile" >{{ trans('surveys.here') }}</a>.</p>
</div>
    </br>
<?php } ?>
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-user"> </i><?php echo trans('surveys.surveys'); ?>
        </div>
        <div class="actions">
            <div class="modal fade" id="import" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="text-align: left;">
                        <div class="modal-header">
                        {{ csrf_field() }}
                            <div class="form-group">
                            </br>
                                <label class="col-md-3 control-label">{{ trans('surveys.newsurvey') }}</label>
                                    <div class="col-md-6">
                                </div>    
                            </div>
                        </div>
                        </br> 
                    </div> 
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable table-scrollable-borderless">
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <th style="width:100px"><?php echo trans('surveys.name'); ?></th>
                        <th style="width:100px"><?php echo trans('surveys.published_date'); ?></th>
                        <th style="width:100px"><?php echo trans('surveys.complete'); ?></th>
                        <th style="width:600px; text-align:right" ><?php echo trans('surveys.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveys as $survey)
                    <tr>
                        <td style="width:20%"><b>{{ $survey->name }}</td>
                        </b>
                        <td style="width:20%"><b>{{ date("d-m-Y", strtotime($survey->published_at))}}</td>
                        </b>
                       
                        <?php
                        //ek- get survey-id
                            $survey_id = $survey->id;
                        //ek- get user id   
                            $user_id = \Auth::user()-> id;  //Esther=15
                        //ek- get all survey_results that match selected survey id
                            $results = SurveyResult::where('survey_id',$survey_id)->get();
                        //ek- match userid and take latest
                            $userresults = $results -> where ('user_id',$user_id)->last();
                                $results = $userresults;
                                if ($results == null) {
                                    $results = trans('surveys.nottaken');
                                } else {
                                    $results = date("d-m-Y", strtotime($results->created_at));
                                }
                        ?>
                         <td style="width:20%"><b>{{$results}}</td>
                        </b>
                        <td style="width: 40%" style="text-align: right";>                                        
                            @if ($results == trans('surveys.nottaken'))
                                <a href="<?php echo url('/takesurvey') . '/' . $survey->id; ?>" class="btn btn-info"><?php echo trans('surveys.takesurvey'); ?></a>
                                <a class="btn btn-info" disabled='true'><?php echo trans('surveys.view'); ?></a>
                            @else
                                <a class="btn btn-info" disabled='true'><?php echo trans('surveys.takesurvey'); ?></a>
                                <a href="<?php echo url('/takesurveyresults') . '/' . $survey->id; ?>" class="btn btn-info"><?php echo trans('surveys.view'); ?></a>
                            @endif
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</div>

@endsection

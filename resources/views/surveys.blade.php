<?php

use App\Http\Models\Survey;
use App\Http\Models\SurveyResult;

$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.surveys');
$protocol = empty($_SERVER['HTTPS']) === true ? 'http://' : 'https://';
$x1 = $protocol . $_SERVER['HTTP_HOST'];
?>

@extends('layouts.app', ['selected' => 'surveys'])

@section('content')

<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-user"></i><?php echo trans('surveys.surveys'); ?>
        </div>
        <div class="actions">
            <div class="form-group">
                <a class="btn btn-default" data-toggle="modal" href="#import">
                    <?php echo trans('surveys.newsurvey'); ?>
                </a>
            </div>
            <div class="modal fade" id="import" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="text-align: left;">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            
                            <h4 class="modal-title"><?php echo trans('surveys.newsurvey'); ?></h4>
                        </div>

                        <form method="post" action="<?php echo url('/newsurvey'); ?>" enctype="multipart/form-data">
                            <div class="modal-body"><?php echo trans('surveys.importupload'); ?>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    </br>
                                    <label class="col-md-3 control-label">{{ trans('surveys.name') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa fa-warning"></i>
                                            <input name="surveyname" id="surveyname" type="text" class="form-control" placeholder="{{ trans ('surveys.name') }}" required>
                                        </div>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group">
                                    </br>
                                    <label class="col-md-3 control-label">{{ trans('surveys.published_date') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa fa-warning"></i>
                                            <input name="surveypublished_at" id="surveypublished_at" type="date" class="form-control" placeholder="{{ trans ('surveys.published_date') }}" required>
                                        </div>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group">
                                    </br>
                                    <label class="col-md-3 control-label">{{ trans('surveys.anonymous') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa fa-warning"></i>
                                            <!-- ANONYMOUS CHECKBOX -->
                                            <div class="md-checkbox-inline">
                                                <div class="md-checkbox">
                                                    <input type="checkbox" id="anonymous" name="anonymous" class="md-check">
                                                    <label for="anonymous">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </br>
                                <div class="form-group">
                                    </br>
                                    <label class="col-md-3 control-label">{{ trans('surveys.noemail') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa fa-warning"></i>
                                            <!-- NO EMAIL CHECKBOX -->
                                            <div class="md-checkbox-inline">
                                                <div class="md-checkbox">
                                                    <input type="checkbox" id="no_email" name="no_email" class="md-check">
                                                    <label for="no_email">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo trans('surveys.cancel'); ?></button>
                                <button class="btn btn-warning" type="submit"><?php echo trans('surveys.createsurvey'); ?></button>
                            </div>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable table-scrollable-borderless">
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <th style="width:100px"><?php echo trans('surveys.name'); ?></th>
                        <th style="width:100px"><?php echo trans('surveys.anonymous'); ?></th>
                        <th style="width:100px"><?php echo trans('surveys.noemail'); ?></th>
                        <th style="width:100px; text-align:left"><?php echo trans('surveys.published_date'); ?></th>
                        <th style="width:600px; text-align:right"><?php echo trans('surveys.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- date of today -->
                    <?php $date_today = (strftime("/%Y%m%d")); ?>

                    @foreach ($surveys as $survey)
                    <tr>
                        <td><b>{{ $survey->name }} </b></td>
                        <td><b>
                                @if ($survey->anonymous)
                                <i class="fa fa-check" aria-hidden="true"></i>
                                @endif
                            </b></td>
                        <td><b>
                                @if ($survey->no_email)
                                <i class="fa fa-check" aria-hidden="true"></i>
                                @endif
                            </b></td>
                        <td><b>{{ date("d-m-Y", strtotime($survey->published_at))}} </b></td>
                        <!-- Action buttons -->
                        <td style="text-align: right;">
                            <!-- check if result for survey-id exists  -->

                            <script type="text/javascript">
                                function noresults() {
                                    //var message = <?php //echo trans('surveys.noresults'); 
                                                    ?>
                                    alert('<?php echo trans('surveys.noresults'); ?>');
                                }
                            </script>

                            <?php
                            $survey_id = $survey->id;
                            $results = SurveyResult::where('survey_id', $survey_id)->get();

                            if (!$results->isEmpty() || !$results != null) {
                            ?>
                                <a href="<?php echo url('/surveyresults') . '/' . $survey->id; ?>" class="btn btn-primary"><?php echo trans('surveys.result'); ?></a>
                            <?php
                            } else {
                            ?>
                                <a class="btn btn-primary" onclick="noresults()"><?php echo trans('surveys.result'); ?></a>

                            <?php
                            }
                            ?>

                            <!-- if publish_date is in the past: disable buttons edit, change and delete -->
                            @if(date("/Ymd", strtotime($survey->published_at)) > $date_today)
                            <a href="<?php echo url('/editsurvey') . '/' . $survey->id; ?>" class="btn btn-info"><?php echo trans('surveys.edit'); ?></a>
                            <a class="btn btn-info" data-toggle="modal" href="#editchange<?php echo $survey->id; ?>"><?php echo trans('surveys.change'); ?></a>
                            @endif

                            <!-- modal edit survey -->
                            <div class="modal fade" id="editchange<?php echo $survey->id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="text-align: left;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                           
                                            <h4 class="modal-title"><?php echo trans('surveys.change'); ?></h4>
                                        </div>
                                        <form method="post" action="<?php echo url('/changedateandname') . '/' . $survey->id; ?>" enctype="multipart/form-data">
                                            <div class="modal-body"><?php echo trans('surveys.changeimportupload'); ?>
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    </br>
                                                    <label class="col-md-3 control-label">{{ trans('surveys.name') }}</label>
                                                    <div class="col-md-6">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-warning" style='margin-right: 0px; '></i>
                                                            <input name="surveyname" id="surveyname" type="text" class="form-control" placeholder="<?php echo ($survey->name); ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="form-group">
                                                    </br>
                                                    <label class="col-md-3 control-label">{{ trans('surveys.published_date') }}</label>

                                                    <div class="col-md-6">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-warning" style='margin-right: 0px; '></i>
                                                            <input name="surveypublished_at" id="surveypublished_at" type="date" class="form-control" placeholder="{{ $survey->published_at}} " required>
                                                        </div>
                                                    </div>
                                                </div>
                                                </br>

                                                <div class="form-group">
                                                    </br>
                                                    <label class="col-md-3 control-label">{{ trans('surveys.anonymous') }}</label>
                                                    <div class="col-md-6">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-warning" style='margin-right: 0px;'></i>
                                                            <!-- ANONYMOUS CHECKBOX -->
                                                            <div class="md-checkbox-inline">
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" id="anonymous{{$survey->id}}" name="anonymous" class="md-check">
                                                                    <label for="anonymous{{$survey->id}}">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </br>

                                                <div class="form-group">
                                                    </br>
                                                    <label class="col-md-3 control-label">{{ trans('surveys.noemail') }}</label>
                                                    <div class="col-md-6">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-warning" style='margin-right: 0px;'></i>
                                                            <!-- NO EMAIL CHECKBOX -->
                                                            <div class="md-checkbox-inline">
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" id="no_email{{$survey->id}}" name="no_email" class="md-check">
                                                                    <label for="no_email{{$survey->id}}">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo trans('surveys.cancel'); ?></button>
                                                <button class="btn btn-warning" type="submit"><?php echo trans('surveys.acceptchanges'); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            

                            <!-- Add Duplicate button  -->
                            <a class="btn btn-info" data-toggle="modal" href="#duplicate<?php echo $survey->id; ?>"><?php echo trans('surveys.duplicate'); ?></a>
                            <!--  pop-up -->
                            <div class="modal fade" id="duplicate<?php echo $survey->id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="text-align: left;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title"><?php echo trans('surveys.duplicate'); ?></h4>
                                        </div>
                                        <!-- form pop-up -->
                                        <form method="post" action="<?php echo url('/duplicate') . '/' . $survey->id; ?>" enctype="multipart/form-data">
                                            <div class="modal-body"><?php echo trans('surveys.changeimportupload'); ?>
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    </br>
                                                    <label class="col-md-3 control-label">{{ trans('surveys.name') }}</label>
                                                    <div class="col-md-6">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-warning" style='margin-right: 0px; '></i>
                                                            <input name="surveyname" id="surveyname" type="text" class="form-control" placeholder="{{ trans ('surveys.name') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="form-group">
                                                    </br>
                                                    <label class="col-md-3 control-label">{{ trans('surveys.published_date') }}</label>
                                                    <div class="col-md-6">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-warning" style='margin-right: 0px; '></i>
                                                            <input name="surveypublished_at" id="surveypublished_at" type="date" class="form-control" placeholder="{{ trans ('surveys.published_date') }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="form-group">
                                                    </br>
                                                    <label class="col-md-3 control-label">{{ trans('surveys.anonymous') }}</label>
                                                    <div class="col-md-6">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-warning" style='margin-right: 0px;'></i>
                                                            <!-- ANONYMOUS CHECKBOX -->
                                                            <div class="md-checkbox-inline">
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" id="anonymous_d{{$survey->id}}" name="anonymous" class="md-check">
                                                                    <label for="anonymous_d{{$survey->id}}">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="form-group">
                                                    </br>
                                                    <label class="col-md-3 control-label">{{ trans('surveys.noemail') }}</label>
                                                    <div class="col-md-6">
                                                        <div class="input-icon right">
                                                            <i class="fa fa-warning" style='margin-right: 0px;'></i>
                                                            <!-- NO EMAIL CHECKBOX -->
                                                            <div class="md-checkbox-inline">
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" id="no_email_d{{$survey->id}}" name="no_email" class="md-check">
                                                                    <label for="no_email_d{{$survey->id}}">
                                                                        <span class="inc"></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </br>
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo trans('surveys.cancel'); ?></button>
                                                <button class="btn btn-warning" type="submit"><?php echo trans('surveys.duplicatesurvey'); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!--/.modal-dialog-->

                            <!-- Add Copy Link Button -->
                            @if($survey->anonymous)
                            <a class="btn btn-success" onclick="copylink({{$survey->id}})"><?php echo trans('surveys.copylink'); ?></a>
                            @endif

                            <!-- Add Delete Button -->
                            @if(date("/Ymd", strtotime($survey->published_at)) > $date_today)
                            <a class="btn btn-warning" data-toggle="modal" href="#delete<?php echo $survey->id; ?>"><?php echo trans('surveys.delete'); ?></a>
                            @endif
                            <div class="modal fade" id="delete<?php echo $survey->id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="text-align: left;">
                                        <form method="post" action="<?php echo url('/deletesurvey') . '/' . $survey->id; ?>">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title"><?php echo trans('surveys.delete'); ?></h4>
                                            </div>
                                            <div class="modal-body"><?php echo trans('surveys.surveydelete'); ?></div>
                                            {{ csrf_field() }}
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo trans('surveys.cancel'); ?></button>
                                                <button class="btn btn-danger" type="submit"><?php echo trans('surveys.delete'); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="appsforce-help">
</div>

<script>
    function copylink(id) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val('{{ $x1 }}/mysurvey/takeanonymoussurvey/' + id).select();
        document.execCommand("copy");
        $temp.remove();
        alert('{{ trans("surveys.linkcopied") }}');
    }
</script>
@endsection
<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.reports');
?>
@extends('layouts.app', ['selected' => 'reports'])

@section('content')
<?php
global $theme;
if ($theme != "vuexy") {
?>
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-user"></i><?php echo trans('surveys.reports'); ?><!--Report in lang file-->
        </div>
        <div class="actions">
            <div class="form-group">
                <a href="<?php echo url('/addnewreport'); ?>" class="btn btn-default">
                    <?php echo trans('surveys.addnewrepif ort'); ?></a>
                <!--add new report button-->
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table-scrollable table-scrollable-borderless">
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <th style="width:100px; text-align:left"><?php echo trans('surveys.name'); ?></th>
                        <th style="width:600px; text-align:right"><?php echo trans('surveys.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)

                    <tr>
                        <td><b>{{ $report->report_name }} </b>

                        </td>
                        <td style="text-align: right;">
                            <a href="<?php echo url('/viewreport') . '/' . $report->id; ?>" class="btn btn-primary"><?php echo trans('surveys.view'); ?></a>
                            <div style="display:inline;"></div>

                            <a href="<?php echo url('/editreport') . '/' . $report->id; ?>" class="btn btn-info"><?php echo trans('surveys.edit'); ?></a>

                            <!-- Add Delete Button -->

                            <a class="btn btn-warning" data-toggle="modal" href="#delete<?php echo $report->id; ?>">
                                <?php echo trans('surveys.delete'); ?>
                            </a>
                            <div class="modal fade" id="delete<?php echo $report->id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="text-align: left;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title"><?php echo trans('surveys.delete'); ?></h4>
                                        </div>
                                        <div class="modal-body"><?php echo trans('surveys.deletereport'); ?></div>
                                        <form method="post" action="<?php echo url('/deletereport') . '/' . $report->id; ?>">
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
<?php } else { ?>
test

<?php } ?>
@endsection
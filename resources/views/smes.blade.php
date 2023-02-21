<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.smes');
?>
@extends('layouts.app', ['selected' => 'smes'])

@section('content')

<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-user"></i><?php echo trans('surveys.smes'); ?>
        </div>
        <div class="actions">
            <div class="form-group">
                <a href="<?php echo url('/addsme'); ?>" class="btn btn-default">
                    <?php echo trans('surveys.addsme'); ?></a>
            </div>
        </div>
    </div>

    <div class="portlet-body">
        <div class="table-scrollable table-scrollable-borderless">
            <table class="table table-hover table-light">
                <thead>
                    <tr>
                        <!-- we need to display company name, city and industry -->
                        <th style="width:100px;"><?php echo trans('surveys.name'); ?></th>
                        <th style="width:100px;"><?php echo trans('surveys.city'); ?></th>
                        <th style="width:100px;"><?php echo trans('surveys.industry'); ?></th>
                        <th style="width:600px; text-align:right"><?php echo trans('surveys.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($smes as $sme)
                    <tr>
                        <td>
                            <b>{{ $sme->company_name}} </b>
                        </td>
                        <td>
                            <b>{{ $sme->town }} </b>
                        </td>
                        @if ($sme->sector == "other")
                        <td>
                            {{$sme->sector_other}}
                        </td>
                        @else
                        <td>
                            <?php echo trans('surveys.sector' . $sme->sector); ?>
                        </td>
                        @endif

                        <style>
                            .modal-backdrop,
                            .modal-backdrop.fade.in {
                                display: none;
                            }

                            .modal-backdrop.in {
                                display: none;
                            }
                        </style>

                        <td style="text-align: right;">
                            <a href="<?php echo url('/infosme') . '/' . $sme->id; ?>" class="btn btn-primary"><?php echo trans('surveys.buttoninfo'); ?></a>
                            <!-- <a href="<?php //echo url('/viewsme') . '/' . $sme->id; 
                                            ?>"  class="btn btn-primary"><?php //echo trans('surveys.view'); 
                                                                            ?></a> -->
                            <a href="<?php echo url('/editsme') . '/' . $sme->id; ?>" class="btn btn-info"><?php echo trans('surveys.edit'); ?></a>
                            <a class="btn btn-warning" data-toggle="modal" href="#delete<?php echo $sme->id; ?>"><?php echo trans('surveys.delete'); ?></a>
                            <div class="modal fade" id="delete<?php echo $sme->id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="text-align: left;">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                            <h4 class="modal-title"><?php echo trans('surveys.delete'); ?></h4>
                                        </div>
                                        <div class="modal-body"><?php echo trans('surveys.smedelete'); ?></div>
                                        <form method="post" action="<?php echo url('/deletesme') . '/' . $sme->id; ?>">
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

@endsection
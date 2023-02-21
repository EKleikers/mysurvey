<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.addnewreport');
?>
@extends('layouts.app', ['selected' => 'reports'])

@section('content')

<div class="portlet light bordered">
    @include('includes.errors')
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i><?php echo trans('surveys.addnewreport'); ?></div>  
    </div>
    <div class="portlet-body form">
        <form action="<?php echo url('/addnewreport'); ?>" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
            {{ csrf_field() }}
            <div class="form-body">
                
            <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.survey_select'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="survey_select" id="survey_select" class="form-control" required>

                            <option value="" selected hidden style="display:none"><?php echo trans('surveys.surveychoice'); ?></option>
                            @foreach ($surveys as $survey)
                            <option value="{{ $survey->id }}">{{ $survey->name }}</option>
                            @endforeach
                            </select>   
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.reportname'); ?></label>
                    <div class="col-md-6">
                        <input name="report_name" id="report_name" type="text" maxlength="100" required class="form-control"  placeholder="<?php echo trans('surveys.reportname');  ?>"  >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.active'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="national_international" id="national_international" class="form-control" required>
                                <option value="0"><?php echo trans('surveys.all'); ?></option>
                                <option value="1"><?php echo trans('surveys.active1'); ?></option>
                                <option value="2"><?php echo trans('surveys.active2'); ?></option>
                                <option value="3"><?php echo trans('surveys.active3'); ?></option>
                            </select>   
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.legal'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i> 
                        </div> 
                            <select name="legal_form" id="legal_form" class="form-control" 
                                required>
                                <option value="0"><?php echo trans('surveys.all'); ?></option>
                                <option value="1"><?php echo trans('surveys.legal1'); ?></option>
                                <option value="2"><?php echo trans('surveys.legal2'); ?></option>
                                <option value="3"><?php echo trans('surveys.legal3'); ?></option>
                                <option value="4"><?php echo trans('surveys.legal4'); ?></option>
                                <option value="5"><?php echo trans('surveys.legal5'); ?></option>
                                <option value="6"><?php echo trans('surveys.legal6'); ?></option>
                                <option value="7"><?php echo trans('surveys.legal7'); ?></option>
                                <option value="8"><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.sector'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="business_sector" id="business_sector" class="form-control" 
                                required>
                                <option value="0"><?php echo trans('surveys.all'); ?></option>
                                <option value="1"><?php echo trans('surveys.sector1'); ?></option>
                                <option value="2"><?php echo trans('surveys.sector2'); ?></option>
                                <option value="3"><?php echo trans('surveys.sector3'); ?></option>
                                <option value="4"><?php echo trans('surveys.sector4'); ?></option>
                                <option value="5"><?php echo trans('surveys.sector5'); ?></option>
                                <option value="6"><?php echo trans('surveys.sector6'); ?></option>
                                <option value="7"><?php echo trans('surveys.sector7'); ?></option>
                                <option value="8"><?php echo trans('surveys.sector8'); ?></option>
                                <option value="9"><?php echo trans('surveys.sector9'); ?></option>
                                <option value="10"><?php echo trans('surveys.sector10'); ?></option>
                                <option value="11"><?php echo trans('surveys.sector10'); ?></option>
                                <option value="12"><?php echo trans('surveys.sector11'); ?></option>
                                <option value="13"><?php echo trans('surveys.sector12'); ?></option>
                                <option value="14"><?php echo trans('surveys.sector13'); ?></option>
                                <option value="15"><?php echo trans('surveys.sector14'); ?></option>
                                <option value="16"><?php echo trans('surveys.sector15'); ?></option>
                                <option value="17"><?php echo trans('surveys.sector16'); ?></option>
                                <option value="18"><?php echo trans('surveys.sector17'); ?></option>
                                <option value="19"><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>
               

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.exist'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i> 
                        </div>
                            <select name="time_existence" id="time_existence" class="form-control" required>
                                <option value="0"><?php echo trans('surveys.all'); ?></option>
                                <option value="1"><?php echo trans('surveys.exist1'); ?></option>
                                <option value="2"><?php echo trans('surveys.exist2'); ?></option>
                                <option value="3"><?php echo trans('surveys.exist3'); ?></option>
                                <option value="4"><?php echo trans('surveys.exist4'); ?></option>
                                <option value="5"><?php echo trans('surveys.exist5'); ?></option>
                            </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.size'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning", class="fa fa-warning"></i>
                        </div>
                            <select name="number_employees" id="number_employees" class="form-control" required>
                                <option value="0"><?php echo trans('surveys.all'); ?></option>
                                <option value="1"><?php echo trans('surveys.size1'); ?></option>
                                <option value="2"><?php echo trans('surveys.size2'); ?></option>
                                <option value="3"><?php echo trans('surveys.size3'); ?></option>
                                <option value="4"><?php echo trans('surveys.size4'); ?></option>
                            </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.turnover'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning", class="fa fa-warning"></i>
                        </div>
                            <select name="company_turnover" id="turncompany_turnoverover" class="form-control" required>
                                <option value="0"><?php echo trans('surveys.all'); ?></option>
                                <option value="1"><?php echo trans('surveys.turnover1'); ?></option>
                                <option value="2"><?php echo trans('surveys.turnover2'); ?></option>
                                <option value="3"><?php echo trans('surveys.turnover3'); ?></option>
                                <option value="4"><?php echo trans('surveys.turnover4'); ?></option>
                                <option value="5"><?php echo trans('surveys.turnover5'); ?></option>
                                <option value="6"><?php echo trans('surveys.turnover6'); ?></option>
                                <option value="7"><?php echo trans('surveys.turnover7'); ?></option>
                                <option value="8"><?php echo trans('surveys.turnover8'); ?></option>
                            </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.supply'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="sales_market" id="sales_market" class="form-control" 
                                required>
                                <option value="0"><?php echo trans('surveys.all'); ?></option>
                                <option value="1"><?php echo trans('surveys.supply1'); ?></option>
                                <option value="2"><?php echo trans('surveys.supply2'); ?></option>
                                <option value="3"><?php echo trans('surveys.supply3'); ?></option>
                                <option value="4"><?php echo trans('surveys.supply4'); ?></option>
                                <option value="5"><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>
        

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.it'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="it_arrangement" id="it_arrangement" class="form-control" 
                                required>
                                <option value="0"><?php echo trans('surveys.all'); ?></option>
                                <option value="1"><?php echo trans('surveys.it1'); ?></option>
                                <option value="2"><?php echo trans('surveys.it2'); ?></option>
                                <option value="3"><?php echo trans('surveys.it3'); ?></option>
                                <option value="4"><?php echo trans('surveys.other'); ?></option>
                            </select>  
                    </div>
                </div>

            </div>
            <div class="form-actions fluid">
                <button type="submit" class="btn btn-success" ><?php echo trans('surveys.save'); ?></button>
            </div>
        </form>
    </div>
</div>

@endsection

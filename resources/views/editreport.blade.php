+<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.editreport');
?>
@extends('layouts.app', ['selected' => 'reports'])

@section('content')

<div class="portlet light bordered">
    @include('includes.errors')
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i><?php echo trans('surveys.editreport'); ?></div>  
    </div>
    <div class="portlet-body form">
        <form action="<?php echo url('/editreport') . '/' . $report->id; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
            {{ csrf_field() }}
            <div class="form-body">
                
            <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.reportname'); ?></label>
                    <div class="col-md-6">
                        <input name="reportname" id="reportname" type="text" maxlength="100" required class="form-control"  placeholder="<?php echo trans("$report->report_name"); ?>" value="{{ $report->report_name}}" required>
                    </div>
                </div>
    
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.survey'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                      

                        <select name="survey_select" id="survey_select" class="form-control" required>
                            <option value="" selected hidden style="display:none"><?php echo trans($report->survey_select); ?></option>
                            @foreach ($surveys as $survey)

                                <option value="{{ $survey->id }}" <?php if ($survey->id == $report->survey_select) echo "selected"; ?>>{{ $survey->name }}</option>
                            @endforeach
                        </select>     
                            
  
                    </div>
                </div> 
           

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.active'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                        <select name="national_international" id="national_international" class="form-control"required>
                                <option value="0" <?php echo $report->national_international==0 ? 'selected' : ''; ?>><?php echo trans('surveys.all'); ?></option>
                                <option value="1" <?php echo $report->national_international==1 ? 'selected' : ''; ?>><?php echo trans('surveys.active1'); ?></option>
                                <option value="2" <?php echo $report->national_international==2 ? 'selected' : ''; ?>><?php echo trans('surveys.active2'); ?></option>
                                <option value="3" <?php echo $report->national_international==3 ? 'selected' : ''; ?>><?php echo trans('surveys.active3'); ?></option>  
                            </select>    
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.legal'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i> 
                        </div> 
                            <select name="legal_form" id="legal_form" class="form-control" required>
                                <option value="0" <?php echo $report->legal_form==0 ? 'selected' : ''; ?>><?php echo trans('surveys.all'); ?></option>
                                <option value="1" <?php echo $report->legal_form==1 ? 'selected' : ''; ?>><?php echo trans('surveys.legal1'); ?></option>
                                <option value="2" <?php echo $report->legal_form==2 ? 'selected' : ''; ?>><?php echo trans('surveys.legal2'); ?></option>
                                <option value="3" <?php echo $report->legal_form==3 ? 'selected' : ''; ?>><?php echo trans('surveys.legal3'); ?></option>
                                <option value="4" <?php echo $report->legal_form==4 ? 'selected' : ''; ?>><?php echo trans('surveys.legal4'); ?></option>
                                <option value="5" <?php echo $report->legal_form==5 ? 'selected' : ''; ?>><?php echo trans('surveys.legal5'); ?></option>
                                <option value="6" <?php echo $report->legal_form==6 ? 'selected' : ''; ?>><?php echo trans('surveys.legal6'); ?></option>
                                <option value="7" <?php echo $report->legal_form==7 ? 'selected' : ''; ?>><?php echo trans('surveys.legal7'); ?></option>
                                <option value="8" <?php echo $report->legal_form==8 ? 'selected' : ''; ?>><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.sector'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="business_sector" id="business_sector" class="form-control"required>
                                <option value="0" <?php echo $report->business_sector==0 ? 'selected' : ''; ?>><?php echo trans('surveys.all'); ?></option>
                                <option value="1" <?php echo $report->business_sector==1 ? 'selected' : ''; ?>><?php echo trans('surveys.sector1'); ?></option>
                                <option value="2" <?php echo $report->business_sector==2 ? 'selected' : ''; ?>><?php echo trans('surveys.sector2'); ?></option>
                                <option value="3" <?php echo $report->business_sector==3 ? 'selected' : ''; ?>><?php echo trans('surveys.sector3'); ?></option>
                                <option value="4" <?php echo $report->business_sector==4 ? 'selected' : ''; ?>><?php echo trans('surveys.sector4'); ?></option>
                                <option value="5" <?php echo $report->business_sector==5 ? 'selected' : ''; ?>><?php echo trans('surveys.sector5'); ?></option>
                                <option value="6" <?php echo $report->business_sector==6 ? 'selected' : ''; ?>><?php echo trans('surveys.sector6'); ?></option>
                                <option value="7" <?php echo $report->business_sector==7 ? 'selected' : ''; ?>><?php echo trans('surveys.sector7'); ?></option>
                                <option value="8" <?php echo $report->business_sector==8 ? 'selected' : ''; ?>><?php echo trans('surveys.sector8'); ?></option>
                                <option value="9" <?php echo $report->business_sector==9 ? 'selected' : ''; ?>><?php echo trans('surveys.sector9'); ?></option>
                                <option value="10" <?php echo $report->business_sector==10 ? 'selected' : ''; ?>><?php echo trans('surveys.sector10'); ?></option>
                                <option value="11" <?php echo $report->business_sector==11 ? 'selected' : ''; ?>><?php echo trans('surveys.sector11'); ?></option>
                                <option value="12" <?php echo $report->business_sector==12 ? 'selected' : ''; ?>><?php echo trans('surveys.sector12'); ?></option>
                                <option value="13" <?php echo $report->business_sector==13 ? 'selected' : ''; ?>><?php echo trans('surveys.sector13'); ?></option>
                                <option value="14" <?php echo $report->business_sector==14 ? 'selected' : ''; ?>><?php echo trans('surveys.sector14'); ?></option>
                                <option value="15" <?php echo $report->business_sector==15 ? 'selected' : ''; ?>><?php echo trans('surveys.sector15'); ?></option>
                                <option value="16" <?php echo $report->business_sector==16 ? 'selected' : ''; ?>><?php echo trans('surveys.sector16'); ?></option>
                                <option value="17" <?php echo $report->business_sector==17 ? 'selected' : ''; ?>><?php echo trans('surveys.sector17'); ?></option>
                                <option value="18" <?php echo $report->business_sector==18 ? 'selected' : ''; ?>><?php echo trans('surveys.sector18'); ?></option>
                                <option value="19" <?php echo $report->business_sector==19 ? 'selected' : ''; ?>><?php echo trans('surveys.other'); ?></option>
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
                                <option value="0" <?php echo $report->time_existence==0 ? 'selected' : ''; ?>><?php echo trans('surveys.all'); ?></option>
                                <option value="1" <?php echo $report->time_existence==1 ? 'selected' : ''; ?>><?php echo trans('surveys.exist1'); ?></option>
                                <option value="2" <?php echo $report->time_existence==2 ? 'selected' : ''; ?>><?php echo trans('surveys.exist2'); ?></option>
                                <option value="3" <?php echo $report->time_existence==3 ? 'selected' : ''; ?>><?php echo trans('surveys.exist3'); ?></option>
                                <option value="4" <?php echo $report->time_existence==4 ? 'selected' : ''; ?>><?php echo trans('surveys.exist4'); ?></option>
                                <option value="5" <?php echo $report->time_existence==5 ? 'selected' : ''; ?>><?php echo trans('surveys.exist5'); ?></option>
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
                                <option value="0" <?php echo $report->number_employees==0 ? 'selected' : ''; ?>><?php echo trans('surveys.all'); ?></option>
                                <option value="1" <?php echo $report->number_employees==1 ? 'selected' : ''; ?>><?php echo trans('surveys.size1'); ?></option>
                                <option value="2" <?php echo $report->number_employees==2 ? 'selected' : ''; ?>><?php echo trans('surveys.size2'); ?></option>
                                <option value="3" <?php echo $report->number_employees==3 ? 'selected' : ''; ?>><?php echo trans('surveys.size3'); ?></option>
                                <option value="4" <?php echo $report->number_employees==4 ? 'selected' : ''; ?>><?php echo trans('surveys.size4'); ?></option>
                            </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.turnover'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="company_turnover" id="company_turnover" class="form-control" required>
                                <option value="0" <?php echo $report->company_turnover==0 ? 'selected' : ''; ?>><?php echo trans('surveys.all'); ?></option>
                                <option value="1" <?php echo $report->company_turnover==1 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover1'); ?></option>
                                <option value="2" <?php echo $report->company_turnover==2 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover2'); ?></option>
                                <option value="3" <?php echo $report->company_turnover==3 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover3'); ?></option>
                                <option value="4" <?php echo $report->company_turnover==4 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover4'); ?></option>
                                <option value="5" <?php echo $report->company_turnover==5 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover5'); ?></option>
                                <option value="6" <?php echo $report->company_turnover==6 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover6'); ?></option>
                                <option value="7" <?php echo $report->company_turnover==7 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover7'); ?></option>
                                <option value="8" <?php echo $report->company_turnover==8 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover8'); ?></option>
                            </select>
                        
                    </div>
                </div> 
 
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.supply'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="sales_market" id="sales_market" class="form-control" required>
                                <option value="0" <?php echo $report->sales_market==0 ? 'selected' : ''; ?>><?php echo trans('surveys.all'); ?></option>
                                <option value="1" <?php echo $report->sales_market==1 ? 'selected' : ''; ?>><?php echo trans('surveys.supply1'); ?></option>
                                <option value="2" <?php echo $report->sales_market==2 ? 'selected' : ''; ?>><?php echo trans('surveys.supply2'); ?></option>
                                <option value="3" <?php echo $report->sales_market==3 ? 'selected' : ''; ?>><?php echo trans('surveys.supply3'); ?></option>
                                <option value="4" <?php echo $report->sales_market==4 ? 'selected' : ''; ?>><?php echo trans('surveys.supply4'); ?></option>
                                <option value="5" <?php echo $report->sales_market==5 ? 'selected' : ''; ?>><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.it'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="it_arrangement" id="it_arrangement" class="form-control" required>
                                <option value="0" <?php echo $report->it_arrangement==0 ? 'selected' : ''; ?>><?php echo trans('surveys.all'); ?></option>
                                <option value="1" <?php echo $report->it_arrangement==1 ? 'selected' : ''; ?>><?php echo trans('surveys.it1'); ?></option>
                                <option value="2" <?php echo $report->it_arrangement==2 ? 'selected' : ''; ?>><?php echo trans('surveys.it2'); ?></option>
                                <option value="3" <?php echo $report->it_arrangement==3 ? 'selected' : ''; ?>><?php echo trans('surveys.it3'); ?></option>
                                <option value="4" <?php echo $report->it_arrangement==4 ? 'selected' : ''; ?>><?php echo trans('surveys.other'); ?></option>
                            </select>  
                    </div>

            </div>
            <div class="form-actions fluid">
                <button type="submit" class="btn btn-success" ><?php echo trans('surveys.save'); ?></button>
            </div>
        </form>
    </div>
</div>

@endsection



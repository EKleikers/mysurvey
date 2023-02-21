<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/addsme";
$breadcrumb->add($b);
$breadcrumb->name = "Home";
?>
@extends('layouts.app', ['selected' => 'smes'])

@section('content')

<div class="portlet light bordered">
    @include('includes.errors')
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i><?php echo trans('surveys.addsme'); ?></div>
    </div>
    <div class="portlet-body form">

        <form action="<?php echo url('/addsme');?>" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
            {{ csrf_field() }}
            <div class="form-body">
            
            <script>
                    function otherText(selectname, textname) {
                        if ($(selectname).val() == 'other') {
                                $(textname).show();
                            } else {
                                $(textname).hide();
                            }
                    }
            </script>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.company_name'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="company_name" id="company_name" type="text" class="form-control" placeholder="<?php echo trans('surveys.company_name'); ?>" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.address1'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="address1" id="address1" type="text" class="form-control" placeholder="<?php echo trans('surveys.address1'); ?>" required>
                        </div>
                    </div>
                </div> 
 
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.address2'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="address2" id="address2" type="text" class="form-control" placeholder="<?php echo trans('surveys.address2'); ?>" >
                        </div>
                    </div>
                </div> 

                 <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.postcode'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="postcode" id="postcode" type="text" class="form-control" placeholder="<?php echo trans('surveys.postcode'); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.town'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="town" id="town" type="text" class="form-control" placeholder="<?php echo trans('surveys.town'); ?>" required>
                        </div>
                    </div>
                </div> 
 
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.country'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="country" id="country" type="text" class="form-control" placeholder="<?php echo trans('surveys.country'); ?>" required>
                        </div>
                    </div>
                </div> 

                </br></br>
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.role'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="role" id="role" class="form-control" 
                                onchange = "otherText('#role', '#otherrole')"
                                required>
                                <option value = '' selected hidden style="display:none"><?php echo trans('surveys.role-display'); ?></option>
                          
                                <option value="1"><?php echo trans('surveys.role1'); ?></option>
                                <option value="2"><?php echo trans('surveys.role2'); ?></option>
                                <option value="other"><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>
                <div class="form-group" name="otherrole" id="otherrole"  style='display:none;'>  
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                        <input id="roleother" name = "roleother" type="text" class="form-control" placeholder="<?php echo trans('surveys.fillin'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.establishment'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="establishment" id="establishment" class="form-control" required>
                                <option value='' selected hidden style="display:none"><?php echo trans('surveys.establishment-display'); ?></option>
                                <option value="1"><?php echo trans('surveys.establishment1'); ?></option>
                                <option value="2"><?php echo trans('surveys.establishment2'); ?></option>
                                <option value="3"><?php echo trans('surveys.establishment3'); ?></option>
                            </select>   
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.province'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="province" id="province" class="form-control" required>
                                <option value='' selected hidden style="display:none"><?php echo trans('surveys.province-display'); ?></option>
                                <option value="1"><?php echo trans('surveys.province1'); ?></option>
                                <option value="2"><?php echo trans('surveys.province2'); ?></option>
                                <option value="3"><?php echo trans('surveys.province3'); ?></option>
                                <option value="4"><?php echo trans('surveys.province4'); ?></option>
                                <option value="5"><?php echo trans('surveys.province5'); ?></option>
                                <option value="6"><?php echo trans('surveys.province6'); ?></option>
                                <option value="7"><?php echo trans('surveys.province7'); ?></option>
                                <option value="8"><?php echo trans('surveys.province8'); ?></option>
                                <option value="9"><?php echo trans('surveys.province9'); ?></option>
                                <option value="10"><?php echo trans('surveys.province10'); ?></option>
                                <option value="11"><?php echo trans('surveys.province11'); ?></option>
                                <option value="12"><?php echo trans('surveys.province12'); ?></option>
                            </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.active'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="active" id="active" class="form-control" required>
                                <option value='' selected hidden style="display:none"><?php echo trans('surveys.active-display'); ?></option>
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
                            <select name="legal" id="legal" class="form-control" 
                                onchange = "otherText('#legal', '#otherlegal')"
                                required>
                                <option value='' selected hidden style="display:none"><?php echo trans('surveys.legal-display'); ?></option>
                                <option value="1"><?php echo trans('surveys.legal1'); ?></option>
                                <option value="2"><?php echo trans('surveys.legal2'); ?></option>
                                <option value="3"><?php echo trans('surveys.legal3'); ?></option>
                                <option value="4"><?php echo trans('surveys.legal4'); ?></option>
                                <option value="5"><?php echo trans('surveys.legal5'); ?></option>
                                <option value="6"><?php echo trans('surveys.legal6'); ?></option>
                                <option value="7"><?php echo trans('surveys.legal7'); ?></option>
                                
                                <option  id="legal" value="other"><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>
                <div class="form-group" name="otherlegal" id="otherlegal"  style='display:none;'>     
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                        <input id="legalother" name="legalother" type="text" class="form-control" placeholder="<?php echo trans('surveys.fillin'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.sector'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="sector" id="sector" class="form-control" 
                                onchange = "otherText('#sector', '#othersector')"
                                required>
                                <option value='' selected hidden style="display:none"><?php echo trans('surveys.sector-display'); ?></option>
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
                                <option value="11"><?php echo trans('surveys.sector11'); ?></option>
                                <option value="12"><?php echo trans('surveys.sector12'); ?></option>
                                <option value="13"><?php echo trans('surveys.sector13'); ?></option>
                                <option value="14"><?php echo trans('surveys.sector14'); ?></option>
                                <option value="15"><?php echo trans('surveys.sector15'); ?></option>
                                <option value="16"><?php echo trans('surveys.sector16'); ?></option>
                                <option value="17"><?php echo trans('surveys.sector17'); ?></option>
                                <option value="18"><?php echo trans('surveys.sector18'); ?></option>
                                <option id="sector19" value="other"><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>
                <div class="form-group" name="othersector" id="othersector"  style='display:none;'>  
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                        <input id="sectorother" name ="sectorother" type="text" class="form-control" placeholder="<?php echo trans('surveys.fillin'); ?>">
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.exist'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i> 
                        </div>
                            <select name="exist" id="exist" class="form-control" required>
                                <option value='' selected hidden style="display:none"><?php echo trans('surveys.exist-display'); ?></option>
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
                            <select name="size" id="size" class="form-control" required>
                                <option value='' selected hidden style="display:none"><?php echo trans('surveys.size-display'); ?></option>
                                <option value="1"><?php echo trans('surveys.size1'); ?></option>
                                <option value="2"><?php echo trans('surveys.size2'); ?></option>
                                <option value="3"><?php echo trans('surveys.size3'); ?></option>
                                <option value="4"><?php echo trans('surveys.size4'); ?></option>
                                <option value="5"><?php echo trans('surveys.size5'); ?></option>
                            </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.turnover'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                        <i class="fa fa-warning", class="fa fa-warning"></i>
                        </div>
                            <select name="turnover" id="turnover" class="form-control" required>
                                <option value = '' selected hidden style="display:none"><?php echo trans('surveys.turnover-display'); ?></option>
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
                            <select name="supply" id="supply" class="form-control" 
                                onchange = "otherText('#supply', '#othersupply')"
                                required>
                                <option value = '' selected hidden style="display:none"><?php echo trans('surveys.supply-display'); ?></option>
                          
                                <option value="1"><?php echo trans('surveys.supply1'); ?></option>
                                <option value="2"><?php echo trans('surveys.supply2'); ?></option>
                                <option value="3"><?php echo trans('surveys.supply3'); ?></option>
                                <option value="4"><?php echo trans('surveys.supply4'); ?></option>
                                <option value="other"><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>
                <div class="form-group" name="othersupply" id="othersupply"  style='display:none;'>  
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                        <input id="supplyother" name = "supplyother" type="text" class="form-control" placeholder="<?php echo trans('surveys.fillin'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.it'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="it" id="it" class="form-control" 
                                onchange = "otherText('#it', '#otherit')"
                                required>
                                <option value = '' selected hidden style="display:none"><?php echo trans('surveys.it-display'); ?></option>
                                <option value="1"><?php echo trans('surveys.it1'); ?></option>
                                <option value="2"><?php echo trans('surveys.it2'); ?></option>
                                <option value="3"><?php echo trans('surveys.it3'); ?></option>
                                <option value="other"><?php echo trans('surveys.other'); ?></option>
                            </select>  
                    </div>
                </div>
                <div class="form-group" name="otherit" id="otherit"  style='display:none;'>  
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                        <input id="itother" name="itother" type="text" class="form-control" placeholder="<?php echo trans('surveys.fillin'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.short_description'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="short_description" id="short_description" type="text" class="form-control" placeholder="<?php echo trans('surveys.short_description'); ?>" required>
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


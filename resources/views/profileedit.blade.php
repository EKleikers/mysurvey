<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey";
$breadcrumb->add($b);
$breadcrumb->name = "Home";
?>
@extends('layouts.app', ['selected' => 'profile'])

@section('content')

<div class="portlet light bordered">
    @include('includes.errors')
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i><?php echo trans('surveys.editsme'); ?></div>
    </div>
    <div class="portlet-body form">

        <form action="<?php echo url('/profileedit') . '/' . $sme->id; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
            {{ csrf_field() }}
            <div class="form-body" >
            
            <script>
                window.onload = loadText;
                //    onload if other is selected, show other text with value from database 
                function loadText(){
                    if("{{$sme->role}}"  == 'other'|| "{{$sme->role}}"  == 'Anders...'){
                        $('#otherrole').show();
                        roleother.value="{{$sme->role_other}}" 
                    } else{
                        $('#otherlegal').hide();
                    }
                    if("{{$sme->legal}}"  == 'other'|| "{{$sme->legal}}"  == 'Anders...'){
                        $('#otherlegal').show();
                        legalother.value="{{$sme->legal_other}}" 
                    } else{
                        $('#otherlegal').hide();
                    }
                    if("{{$sme->supply}}"  == 'other'|| "{{$sme->legal}}"  == 'Anders...'){
                        $('#othersupply').show();
                        supplyother.value="{{$sme->supply_other}}" 
                    } else{
                        $('#othersupply').hide();
                    }
                    if("{{$sme->sector}}"  == 'other'|| "{{$sme->legal}}"  == 'Anders...'){
                        $('#othersector').show();
                        sectorother.value="{{$sme->sector_other}}" 
                    } else{
                        $('#othersector').hide();
                    }
                    if("{{$sme->it}}"  == 'other'|| "{{$sme->legal}}"  == 'Anders...'){
                        $('#otherit').show();
                        itother.value="{{$sme->it_other}}" 
                    } else{
                        $('#otherit').hide();
                    }
                }
            </script>
            <script>
                function otherText(selectname, textname, number) {
                    if ($(selectname).val() == number) {
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
                            <input name="company_name" id="company_name" type="text" class="form-control" placeholder="<?php echo trans("$sme->company_name"); ?>" value="{{ $sme->company_name}}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.address1'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="address1" id="address1" type="text" class="form-control" placeholder="<?php echo trans("$sme->address1"); ?>" value="{{ $sme->address1}}" required>
                        </div>
                    </div>
                </div> 
 
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.address2'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="address2" id="address2" type="text" class="form-control" placeholder="<?php echo trans("$sme->address2"); ?>" value="{{ $sme->address2}}" >
                        </div>
                    </div>
                </div> 

                 <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.postcode'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="postcode" id="postcode" type="text" class="form-control" placeholder="<?php echo trans("$sme->postcode"); ?>" value="{{ $sme->postcode}}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.town'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="town" id="town" type="text" class="form-control" placeholder="<?php echo trans("$sme->town"); ?>" value="{{ $sme->town}}" required>
                        </div>
                    </div>
                </div> 
 
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.country'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="country" id="country" type="text" class="form-control" placeholder="<?php echo trans("$sme->country"); ?>" value="{{ $sme->country}}" required>
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
                                onchange = "otherText('#role', '#otherrole',3)"
                                required>
                                @if ($sme->role == "other")
                                <option ><?php echo trans('surveys.other'); ?></option>
                                
                                @else
                                <option value="{{ $sme->role}}" selected hidden style="display:none"><?php echo trans("$sme-role"); ?></option>
                              
                                @endif
                                <option value="1" <?php echo $sme->role==1 ? 'selected' : ''; ?>><?php echo trans('surveys.role1'); ?></option>
                                <option value="2" <?php echo $sme->role==2 ? 'selected' : ''; ?>><?php echo trans('surveys.role2'); ?></option>
                                <option value="3" id="other" <?php echo $sme->role==3 ? 'selected' : ''; ?>><?php echo trans('surveys.other'); ?></option>
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
                                <option value="1" <?php echo $sme->establishment==1 ? 'selected' : ''; ?>><?php echo trans('surveys.establishment1'); ?></option>
                                <option value="2" <?php echo $sme->establishment==2 ? 'selected' : ''; ?>><?php echo trans('surveys.establishment2'); ?></option>
                                <option value="3" <?php echo $sme->establishment==3 ? 'selected' : ''; ?>><?php echo trans('surveys.establishment3'); ?></option>
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
                                <option value="1" <?php echo $sme->province==1 ? 'selected' : ''; ?>><?php echo trans('surveys.province1'); ?></option>
                                <option value="2" <?php echo $sme->province==2 ? 'selected' : ''; ?>><?php echo trans('surveys.province2'); ?></option>
                                <option value="3" <?php echo $sme->province==3 ? 'selected' : ''; ?>><?php echo trans('surveys.province3'); ?></option>
                                <option value="4" <?php echo $sme->province==4 ? 'selected' : ''; ?>><?php echo trans('surveys.province4'); ?></option>
                                <option value="5" <?php echo $sme->province==5 ? 'selected' : ''; ?>><?php echo trans('surveys.province5'); ?></option>
                                <option value="6" <?php echo $sme->province==6 ? 'selected' : ''; ?>><?php echo trans('surveys.province6'); ?></option>
                                <option value="7" <?php echo $sme->province==7 ? 'selected' : ''; ?>><?php echo trans('surveys.province7'); ?></option>
                                <option value="8" <?php echo $sme->province==8 ? 'selected' : ''; ?>><?php echo trans('surveys.province8'); ?></option>
                                <option value="9" <?php echo $sme->province==9 ? 'selected' : ''; ?>><?php echo trans('surveys.province9'); ?></option>
                                <option value="10" <?php echo $sme->province==10 ? 'selected' : ''; ?>><?php echo trans('surveys.province10'); ?></option>
                                <option value="11" <?php echo $sme->province==11 ? 'selected' : ''; ?>><?php echo trans('surveys.province11'); ?></option>
                                <option value="12" <?php echo $sme->province==12 ? 'selected' : ''; ?>><?php echo trans('surveys.province12'); ?></option>
                            </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.active'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                        </div>
                            <select name="active" id="active" class="form-control"required>
                                <option value="1" <?php echo $sme->active==1 ? 'selected' : ''; ?>><?php echo trans('surveys.active1'); ?></option>
                                <option value="2" <?php echo $sme->active==2 ? 'selected' : ''; ?>><?php echo trans('surveys.active2'); ?></option>
                                <option value="3" <?php echo $sme->active==3 ? 'selected' : ''; ?>><?php echo trans('surveys.active3'); ?></option>  
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
                                onchange = "otherText('#legal', '#otherlegal',8)"
                                required>
                                @if ($sme->legal == "other")
                                <option ><?php echo trans('surveys.other'); ?></option>
                                @else
                                <option value="{{ $sme->legal}}" selected hidden style="display:none"><?php echo trans("$sme->legal"); ?></option>
                                @endif
                                <option value="1" <?php echo $sme->legal==1 ? 'selected' : ''; ?>><?php echo trans('surveys.legal1'); ?></option>
                                <option value="2" <?php echo $sme->legal==2 ? 'selected' : ''; ?>><?php echo trans('surveys.legal2'); ?></option>
                                <option value="3" <?php echo $sme->legal==3 ? 'selected' : ''; ?>><?php echo trans('surveys.legal3'); ?></option>
                                <option value="4" <?php echo $sme->legal==4 ? 'selected' : ''; ?>><?php echo trans('surveys.legal4'); ?></option>
                                <option value="5" <?php echo $sme->legal==5 ? 'selected' : ''; ?>><?php echo trans('surveys.legal5'); ?></option>
                                <option value="6" <?php echo $sme->legal==6 ? 'selected' : ''; ?>><?php echo trans('surveys.legal6'); ?></option>
                                <option value="7" <?php echo $sme->legal==7 ? 'selected' : ''; ?>><?php echo trans('surveys.legal7'); ?></option>
                                <option value="8" id="other"<?php echo $sme->legal==8 ? 'selected' : ''; ?>><?php echo trans('surveys.other'); ?></option>
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
                                onchange = "otherText('#sector', '#othersector',19)" 
                                required>
                                @if ($sme->legal == "other")
                                <option ><?php echo trans('surveys.other'); ?></option>
                                @else
                                <option value="{{ $sme->sector}}" selected hidden style="display:none"><?php echo trans("$sme->legal"); ?></option>
                                @endif
                                <option value="1" <?php echo $sme->sector==1 ? 'selected' : ''; ?>><?php echo trans('surveys.sector1'); ?></option>
                                <option value="2" <?php echo $sme->sector==2 ? 'selected' : ''; ?>><?php echo trans('surveys.sector2'); ?></option>
                                <option value="3" <?php echo $sme->sector==3 ? 'selected' : ''; ?>><?php echo trans('surveys.sector3'); ?></option>
                                <option value="4" <?php echo $sme->sector==4 ? 'selected' : ''; ?>><?php echo trans('surveys.sector4'); ?></option>
                                <option value="5" <?php echo $sme->sector==5 ? 'selected' : ''; ?>><?php echo trans('surveys.sector5'); ?></option>
                                <option value="6" <?php echo $sme->sector==6 ? 'selected' : ''; ?>><?php echo trans('surveys.sector6'); ?></option>
                                <option value="7" <?php echo $sme->sector==7 ? 'selected' : ''; ?>><?php echo trans('surveys.sector7'); ?></option>
                                <option value="8" <?php echo $sme->sector==8 ? 'selected' : ''; ?>><?php echo trans('surveys.sector8'); ?></option>
                                <option value="9" <?php echo $sme->sector==9 ? 'selected' : ''; ?>><?php echo trans('surveys.sector9'); ?></option>
                                <option value="10" <?php echo $sme->sector==10 ? 'selected' : ''; ?>><?php echo trans('surveys.sector10'); ?></option>
                                <option value="11" <?php echo $sme->sector==11 ? 'selected' : ''; ?>><?php echo trans('surveys.sector11'); ?></option>
                                <option value="12" <?php echo $sme->sector==12 ? 'selected' : ''; ?>><?php echo trans('surveys.sector12'); ?></option>
                                <option value="13" <?php echo $sme->sector==13 ? 'selected' : ''; ?>><?php echo trans('surveys.sector13'); ?></option>
                                <option value="14" <?php echo $sme->sector==14 ? 'selected' : ''; ?>><?php echo trans('surveys.sector14'); ?></option>
                                <option value="15" <?php echo $sme->sector==15 ? 'selected' : ''; ?>><?php echo trans('surveys.sector15'); ?></option>
                                <option value="16" <?php echo $sme->sector==16 ? 'selected' : ''; ?>><?php echo trans('surveys.sector16'); ?></option>
                                <option value="17" <?php echo $sme->sector==17 ? 'selected' : ''; ?>><?php echo trans('surveys.sector17'); ?></option>
                                <option value="18" <?php echo $sme->sector==18 ? 'selected' : ''; ?>><?php echo trans('surveys.sector18'); ?></option>
                                <option value="19" id="other" <?php echo $sme->sector==19 ? 'selected' : ''; ?>><?php echo trans('surveys.other'); ?></option>
                            </select>
                    </div>
                </div>
                <div class="form-group" name="othersector" id="othersector"  style='display:none;'>  
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                        <input id="sectorother" name ="sectorother" type="text" class="form-control" placeholder="<?php echo trans('surveys.fillin'); ?>" >
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.exist'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i> 
                        </div>
                            <select name="exist" id="exist" class="form-control"required>
                                <option value="{{ $sme->exist}}" selected hidden style="display:none"><?php echo trans("$sme->exist"); ?></option>   
                                <option value="1" <?php echo $sme->exist==1 ? 'selected' : ''; ?>><?php echo trans('surveys.exist1'); ?></option>
                                <option value="2" <?php echo $sme->exist==2 ? 'selected' : ''; ?>><?php echo trans('surveys.exist2'); ?></option>
                                <option value="3" <?php echo $sme->exist==3 ? 'selected' : ''; ?>><?php echo trans('surveys.exist3'); ?></option>
                                <option value="4" <?php echo $sme->exist==4 ? 'selected' : ''; ?>><?php echo trans('surveys.exist4'); ?></option>
                                <option value="5" <?php echo $sme->exist==5 ? 'selected' : ''; ?>><?php echo trans('surveys.exist5'); ?></option>
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
                                <option value="{{ $sme->size}}" selected hidden style="display:none"><?php echo trans("$sme->size"); ?></option>
                                <option value="1" <?php echo $sme->size==1 ? 'selected' : ''; ?>><?php echo trans('surveys.size1'); ?></option>
                                <option value="2" <?php echo $sme->size==2 ? 'selected' : ''; ?>><?php echo trans('surveys.size2'); ?></option>
                                <option value="3" <?php echo $sme->size==3 ? 'selected' : ''; ?>><?php echo trans('surveys.size3'); ?></option>
                                <option value="4" <?php echo $sme->size==4 ? 'selected' : ''; ?>><?php echo trans('surveys.size4'); ?></option>
                                <option value="4" <?php echo $sme->size==4 ? 'selected' : ''; ?>><?php echo trans('surveys.size5'); ?></option>
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
                                <option value="1" <?php echo $sme->turnover==1 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover1'); ?></option>
                                <option value="2" <?php echo $sme->turnover==2 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover2'); ?></option>
                                <option value="3" <?php echo $sme->turnover==3 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover3'); ?></option>
                                <option value="4" <?php echo $sme->turnover==4 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover4'); ?></option>
                                <option value="5" <?php echo $sme->turnover==5 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover5'); ?></option>
                                <option value="6" <?php echo $sme->turnover==6 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover6'); ?></option>
                                <option value="7" <?php echo $sme->turnover==7 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover7'); ?></option>
                                <option value="8" <?php echo $sme->turnover==8 ? 'selected' : ''; ?>><?php echo trans('surveys.turnover8'); ?></option>
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
                                onchange = "otherText('#supply', '#othersupply',5)"
                                required>
                                @if ($sme->legal == "other")
                                <option ><?php echo trans('surveys.other'); ?></option>
                                @else
                                <option value="{{ $sme->supply}}" selected hidden style="display:none"><?php echo trans("$sme->legal"); ?></option>
                                @endif
                                <option value="1" <?php echo $sme->supply==1 ? 'selected' : ''; ?>><?php echo trans('surveys.supply1'); ?></option>
                                <option value="2" <?php echo $sme->supply==2 ? 'selected' : ''; ?>><?php echo trans('surveys.supply2'); ?></option>
                                <option value="3" <?php echo $sme->supply==3 ? 'selected' : ''; ?>><?php echo trans('surveys.supply3'); ?></option>
                                <option value="4" <?php echo $sme->supply==4 ? 'selected' : ''; ?>><?php echo trans('surveys.supply4'); ?></option>
                                <option value="5" id="other"<?php echo $sme->supply==5 ? 'selected' : ''; ?>><?php echo trans('surveys.other'); ?></option>
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
                                onchange = "otherText('#it', '#otherit',4)"
                                required>
                                @if ($sme->legal == "other")
                                <option ><?php echo trans('surveys.other'); ?></option>
                                @else
                                <option value="{{ $sme->it}}" selected hidden style="display:none"><?php echo trans("$sme->legal"); ?></option>
                                @endif
                                <option value="1" <?php echo $sme->it==1 ? 'selected' : ''; ?>><?php echo trans('surveys.it1'); ?></option>
                                <option value="2" <?php echo $sme->it==2 ? 'selected' : ''; ?>><?php echo trans('surveys.it2'); ?></option>
                                <option value="3" <?php echo $sme->it==3 ? 'selected' : ''; ?>><?php echo trans('surveys.it3'); ?></option>
                                <option value="4" id="other"<?php echo $sme->it==4 ? 'selected' : ''; ?>><?php echo trans('surveys.other'); ?></option>
                            </select>  
                    </div>
                </div>
                <div class="form-group" name="otherit" id="otherit"  style='display:none;'>  
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                        <input id="itother" name="itother" type="text" class="form-control" placeholder="<?php echo trans('surveys.fillin') ; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.short_description'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="short_description" id="short_description" type="text" class="form-control" placeholder="<?php echo trans('surveys.fillin'); ?>" value="{{ $sme->short_description}}" required>
                        </div>                                                                                              
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


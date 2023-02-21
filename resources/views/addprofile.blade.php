<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/addprofile";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.addprofile');
?>
@extends('layouts.app', ['selected' => 'profile'])

@section('content')


<div class="portlet light bordered">
    @include('includes.errors')
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i><?php echo trans('surveys.editsme'); ?></div>
    </div>
    <div class="portlet-body form">

        <form action="<?php echo url('/editsme') . '/' . $sme->id; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
            {{ csrf_field() }}
            <div class="form-body">

                               
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.company_name'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="company_name" id="company_name" type="text" class="form-control" placeholder="<?php echo trans('surveys.company_name'); ?>" value="{{ $sme->company_name  }}" required>
                        </div>
                    </div>
                </div> 
                
                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.established_year'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="established_year" id="established_year" type="text" class="form-control" placeholder="<?php echo trans('surveys.established_year'); ?>" value="{{ $sme->established_year  }}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.number_employees'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="number_employees" id="number_employees" type="text" class="form-control" placeholder="<?php echo trans('surveys.number_employees'); ?>" value="{{ $sme->number_employees }}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.turnover'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="turnover" id="turnover" type="text" class="form-control" placeholder="<?php echo trans('surveys.turnover'); ?>" value="{{ $sme->turnover  }}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.address1'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="address1" id="address1" type="text" class="form-control" placeholder="<?php echo trans('surveys.address1'); ?>" value="{{ $sme->address1  }}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.address2'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="address2" id="address2" type="text" class="form-control" placeholder="<?php echo trans('surveys.address2'); ?>" value="{{ $sme->address2  }}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.town'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="town" id="town" type="text" class="form-control" placeholder="<?php echo trans('surveys.town'); ?>" value="{{ $sme->town  }}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.country'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="country" id="country" type="text" class="form-control" placeholder="<?php echo trans('surveys.country'); ?>" value="{{ $sme->country  }}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.postcode'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="postcode" id="postcode" type="text" class="form-control" placeholder="<?php echo trans('surveys.postcode'); ?>" value="{{ $sme->postcode  }}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.industry'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="industry" id="industry" type="text" class="form-control" placeholder="<?php echo trans('surveys.industry'); ?>" value="{{ $sme->industry  }}" required>
                        </div>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo trans('surveys.short_description'); ?></label>
                    <div class="col-md-6">
                        <div class="input-icon right">
                            <i class="fa fa-warning"></i>
                            <input name="short_description" id="short_description" type="text" class="form-control" placeholder="<?php echo trans('surveys.short_description'); ?>" value="{{ $sme->short_description  }}" required>
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


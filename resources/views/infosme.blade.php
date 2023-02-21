<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.info');
?>
@extends('layouts.app', ['selected' => 'smes'])

@section('content')

<div class="portlet light bordered">
    @include('includes.errors')
    <div class="portlet-title">
        <div class="caption"><i class="fa fa-reorder"></i><?php echo trans('surveys.info'); ?></div>
    </div>

    <div class="portlet-body form">


        <form action="<?php echo url('/infosme') . '/' . $sme->id; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form" >
            {{ csrf_field() }}
            
        <div class="portlet-body">

            <table class="table table-hover table-light">
                <tr>
                    <td style="width:30%"><?php echo trans('surveys.assigned'); ?></td>
                    <td style="width:30%">{{$surveyCount}}</td>
                </tr>
                    <td><?php echo trans('surveys.taken'); ?></td>
                    <td>{{$surveysTaken}}</td>
                <tr>
                </tr>
                <tr>
                    <td><?php echo trans('surveys.open'); ?></td>
                    <td>{{$surveysOpen}}</td>
                </tr>
            </table>
            <hr>
            <table class="table table-hover table-light">
                    <tr>
                        <td style="width:30%"><?php echo trans('surveys.company_name'); ?></td>
                        <td style="width:30%">{{$sme->company_name}}</td>
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.address1'); ?></td>
                        <td>{{$sme->address1}}</td> 
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.address2'); ?></td>
                        <td>{{$sme->address2}}</td> 
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.postcode'); ?></td>
                        <td>{{$sme->postcode}}</td>
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.town'); ?></td>
                        <td>{{$sme->town}}</td> 
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.country'); ?></td>
                        <td>{{$sme->country}}</td> 
                    </tr>
                    </table>
                    <hr>

                     <table class="table table-hover table-light">
<!-- ek- showong optios selection numbers instead of name -->
                    <tr>
                        <td style="width:30%"><?php echo trans('surveys.role'); ?></td>
                        @if ($sme->role == "other")
                        <td style="width:30%">{{$sme->role_other}}</td> 
                        @else
                        <td style="width:30%"><?php echo trans('surveys.role'.$sme->role); ?></td>
                        @endif
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.establishment'); ?></td>
                        <td> <?php echo trans('surveys.establishment'.$sme->establishment); ?></td> 
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.province'); ?></td>
                        <td><?php echo trans('surveys.province'.$sme->province); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.active'); ?></td>
                        <td><?php echo trans('surveys.active'.$sme->active); ?></td>
    
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.legal'); ?></td>
                        @if ($sme->legal == "other")
                        <td>{{$sme->legal_other}}</td> 
                        @else
                        <td><?php echo trans('surveys.legal'.$sme->legal); ?></td>
                        @endif
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.sector'); ?></td>
                        @if ($sme->sector == "other")
                        <td>{{$sme->sector_other}}</td> 
                        @else
                        <td><?php echo trans('surveys.sector'.$sme->sector); ?></td>
                        @endif
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.exist'); ?></td>
                        <td><?php echo trans('surveys.exist'.$sme->exist); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.size'); ?></td>
                        <td><?php echo trans('surveys.size'.$sme->size); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.turnover'); ?></td>
                        <td><?php echo trans('surveys.turnover'.$sme->turnover); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.supply'); ?></td>
                        @if ($sme->supply == "other")
                        <td>{{$sme->supply_other}}</td> 
                        @else
                        <td><?php echo trans('surveys.supply'.$sme->supply); ?></td>
                        @endif
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.it'); ?></td>
                        @if ($sme->it == "other")
                        <td>{{$sme->it_other}}</td> 
                        @else
                        <td><?php echo trans('surveys.it'.$sme->it); ?></td>
                        @endif
                    </tr>
                    <tr>
                        <td><?php echo trans('surveys.short_description'); ?></td>
                        <td>{{$sme->short_description}}</td> 
                    </tr>
            </table>
        </div>
    </div>
</div>
<div class="portlet light bordered">

    <div class="portlet-title">
    
        <div class="caption"><i class="fa fa-reorder"></i><?php echo trans('surveys.smeanswers'); ?></div>
    </div>

        <select id="select" onchange="selectSurvey()">
            <option value='' selected hidden style="display:none">-Please Select Survey-</option>
            @foreach ($smesurveys as $sme)
            <option value="{{ $sme->id }}">{{ $sme->dropname }}</option>
            @endforeach
        </select>
        <hr>

        <table class="table table-hover table-light" id='smeinfo'></div>

        </table>


        <script>
            function selectSurvey() {
                var selectedid = document.getElementById("select").value;

                var xhttp = new XMLHttpRequest();
                var tablefill = 
                    "<tr>" +
                        "<th style='width:30%'>" + "<?php echo trans('surveys.questions'); ?>" + "</th>" +
                        "<th style='width:30%'>" + "<?php echo trans('surveys.answers'); ?>" + "</th>" +
                    "</tr>";
                xhttp.onreadystatechange = function() 
                    {
                    if (this.readyState == 4 && this.status == 200) 
                        {
                            var json = this.responseText;
                            //decode json of responsetext
                            var obj = JSON.parse(json);
                            //go through the elements 

                            Object.keys(obj).forEach(function(key) {
   
                                tablefill = tablefill + 
                                "<tr>" +
                                    "<td>" + key + "</td>" +
                                    "<td>" + obj[key] + "</td>" +
                                "</tr>"
                             });

                            //alert(this.responseText);
                            document.getElementById("smeinfo").innerHTML = tablefill;
                        }
                    };

                    xhttp.open("GET", '/mysurvey/infodatasme/'+selectedid, true);

                    xhttp.send();
                    
            }
        </script>          
</div>
@endsection



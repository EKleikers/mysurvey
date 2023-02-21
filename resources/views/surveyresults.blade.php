<?php

use App\Http\Models\SME;
use App\Http\Models\Survey;

$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.surveyresults');
?>
@extends('layouts.app', ['selected' => 'reports'])

<link href="/mysurvey/resources/css/jquery.datatables.min.css" type="text/css" rel="stylesheet">
</link>
<link href="/mysurvey/resources/css/buttons.bootstrap.min.css" type="text/css" rel="stylesheet">
</link>

@section('page-style')
<style>
    /* format dataTable export buttons */
    .dt-button.default {
        color: red;
        background-color: yellow;
    }
</style>

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject bold uppercase">{{ trans('surveys.report') }}</span>
                </div>
            </div>
            <div class="portlet-body table-both-scroll">
                <table class="display nowrap" style="width:100%" id="results">
                    <thead>
                        <th> <?php echo trans('surveys.surveyid') ?> </th>
                        <th> <?php echo trans('surveys.userid') ?></th>
                        <th> <?php echo trans('surveys.username') ?></th>
                        <th> <?php echo trans('surveys.companyname') ?></th>

                        @foreach ($questions as $question)
                        <th> {{ $question }} </th>
                        @endforeach
                    </thead>
                    <tbody>
                        <?php
                        foreach ($answers as $answer) {
                            $user_id = $answer->user_id;
                        ?>
                            <tr class="odd gradeX">
                                <td>
                                    <?php
                                    echo $result['survey_id'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($user_id != 0) {
                                        echo $user_id;
                                    } else {
                                        echo trans('surveys.anonymous');
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($user_id != 0) {
                                        // user username
                                        $user = \App\User::where('id', $user_id)->first();
                                        echo $user->name;
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($user_id != 0) {
                                        //company name
                                        $sme = SME::where('user_id', $user_id)->first();
                                        if ($sme != null) {
                                            echo $sme->company_name;
                                        }else{
                                            echo '-';
                                        }
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <?php
                                foreach ($questions as $key => $question) { ?>
                               
                                    <td>
                                        <?php
                                        if (property_exists($answer, $key)) {
                                            if (is_array($answer->$key)) {
                                                //CHECKBOX QUESTIONS
                                                foreach ($answer->$key as $akey) {
                                                    if ($akey != 'other') {
                                                        echo ($akey . ": " . $choices[$key][$akey] . ", </br> ");
                                                    } else {
                                                        echo trans("surveys.other");
                                                    }
                                                }
                                            } elseif ($answer->$key === true) {
                                                echo trans('surveys.yes');
                                            } elseif ($answer->$key === false) {
                                                echo trans('surveys.no');
                                            } elseif ((is_string($answer->$key)) || (is_numeric($answer->$key))) {
                                                echo $answer->$key;
                                                if (array_key_exists($key, $choices)) {
                                                    //dd($key, $choices[$key], $answer->$key);
                                                    if (array_key_exists($answer->$key, $choices[$key])) {
                                                        echo ": " . $choices[$key][$answer->$key];
                                                    }
                                                }
                                                if (array_key_exists($key, $rateValues)) {
                                                    // dd($key, $choices[$key], $answer->$key);
                                                    if (array_key_exists($answer->$key, $rateValues[$key])) {
                                                        echo ": " . $rateValues[$key][$answer->$key];
                                                    }
                                                }
                                            } elseif ((!is_string($answer->$key)) && (!is_numeric($answer->$key))) {
                                                //MATRIX QUESTIONS
                                                foreach ($answer->$key as $xkey => $x) {
                                                    //dd($rows, $columns);
                                                    echo $rows[$key][$xkey].": ".$columns[$key][$x].", </br>";
                                                }
                                            }
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                <?php

                                } ?>

                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="/mysurvey/resources/js/export/jquery-3.5.1.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/jszip.min.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/buttons.pdfmake.min.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/jquery.datatables.min.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/datatables.buttons.min.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/buttons.flash.min.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/buttons.html5.min.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/buttons.print.min.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/buttons.bootstrap.min.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/buttons.colVis.min.js" type="text/javascript"></script>
<script src="/mysurvey/resources/js/export/buttons.flash.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        // $('#results').DataTable();
    });
    $('#results').DataTable({
        //enable horizontal scrolling
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                text: 'Copy Table'
            },
            {
                extend: 'csv',
                text: 'Export to CSV'
            },
            {
                extend: 'excel',
                text: 'Export to Excel'
            }
            // { extend: 'pdf',    text: 'Export tp PDF'},
            // { extend: 'print',  text: 'Print table'}

            // 'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>


@endsection
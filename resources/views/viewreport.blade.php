<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.viewreport');

?>
@extends('layouts.app', ['selected' => 'reports'])

@section('content')
<link href="/mysurvey/resources/css/jquery.datatables.min.css" type="text/css" rel="stylesheet"> </link>
<link href="/mysurvey/resources/css/buttons.bootstrap.min.css" type="text/css" rel="stylesheet"> </link>

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
                <table class="display nowrap" style="width:100%" id="report">
                    <thead>
                        @foreach ($questions as $question)
                        <th> {{ $question }} </th>
                        @endforeach
                    </thead>
                    <tbody>
                        <?php
                        foreach ($answers as $answer) {
                        ?>
                            <tr class="odd gradeX">
                                <?php
                                foreach ($questions as $key => $question) {
                                ?>
                                    <td>
                                        <?php
                                        // dd($answer, $key);
                                        if (property_exists($answer, $key)) {
                                            echo $answer->$key;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </td>
                                <?php } ?>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<p>
<?php echo ('RadarChart'); ?></p>

<div id="chartdiv"></div>

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
<script >
$(document).ready(function() {
       // $('#report').DataTable();
    });
    $('#report').DataTable({
        //enable horizontal scrolling
        "scrollX": true, 
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy',   text: 'Copy Table'},
            { extend: 'csv',    text: 'Export to CSV'},
            { extend: 'excel',  text: 'Export to Excel'}
            // { extend: 'pdf',    text: 'Export tp PDF'},
            // { extend: 'print',  text: 'Print table'}

            // 'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>


@endsection
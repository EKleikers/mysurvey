<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/takesurvey/{id}";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.home');
?>
@extends('layouts.take', ['selected' => 'home'])

@section('content')

<script>
    var surveyJSON = <?php echo $survey->json; ?>;
    var surveyid = "<?php echo $survey->id; ?>";
</script>

<div id="surveyContainer">
    <div id="surveyContainer"></div>
</div>

@endsection

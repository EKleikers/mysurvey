<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.newsurvey');
?>
@extends('layouts.app', ['selected' => 'surveys'])

@section('content')
<div id="surveyContainer">
    <div id="creatorElement"></div>
</div>

<script>
    var surveyname = "<?php echo $name; ?>";
    var surveypublished_at = "<?php echo $published_at; ?>";
    var language = "<?php echo $language; ?>";
    var anonymous = "<?php echo $anonymous; ?>";
    var no_email = "<?php echo $no_email; ?>";
</script>

@endsection

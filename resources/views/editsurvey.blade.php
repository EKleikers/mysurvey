<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/mysurvey/surveys";
$breadcrumb->add($b);
$breadcrumb->name = trans('surveys.editsurvey');
?>
@extends('layouts.app', ['selected' => 'surveys'])

@section('content')
<script>
    var surveyjson = <?php echo $survey->json; ?>;
    var surveyname = "<?php echo $survey->name; ?>";
    var language = "<?php echo $language; ?>";
    var surveypublished_at = "<?php echo $survey->published_at; ?>";
    var anonymous = "<?php echo $anonymous; ?>";
    var no_email = "<?php echo $no_email; ?>";
</script>

<div id="surveyContainer">
    <div id="creatorElement"></div>
</div>


@endsection

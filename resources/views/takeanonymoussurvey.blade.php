
@extends('layouts.takeanonymous')

@section('content')

<h1>  {{ $survey->name }}<h1>

<script>
    var surveyJSON = <?php echo $survey->json; ?>;
    var surveyid = "<?php echo $survey->id; ?>";
</script>

<div id="surveyContainer">
    <div id="surveyContainer"></div>
</div>

@endsection




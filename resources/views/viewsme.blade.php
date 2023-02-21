<?php
$breadcrumb = new \Illuminate\Support\Collection();
$b = new stdClass();
$b->name = "mySurvey";
$b->link = "/viewsme/{id}";
$breadcrumb->add($b);
$breadcrumb->name = "Home";
?>
@extends('layouts.app', ['selected' => 'smes'])

@section('content')


@endsection

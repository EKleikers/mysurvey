<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Auth::routes(['verify' => true]);


//Both
Route::get('/', 'HomeController@index'); //First login redirect to Home/Survey

//Admin - should have access to survers and report
Route::get('/surveys', 'SurveyController@surveys');
Route::post('/newsurvey', 'SurveyController@newsurvey');
Route::get('/editsurvey/{id}', 'SurveyController@editsurvey');
Route::post('/deletesurvey/{id}', 'SurveyController@delete');
Route::post('/surveysave', 'SurveyController@save');
Route::post('/saveresult', 'SMEController@saveresult'); //changed controller
Route::post('/changedateandname/{id}', 'SurveyController@changedateandname');
Route::post('/duplicate/{id}', 'SurveyController@duplicate');
Route::get('/smes', 'SurveyController@showSMEs'); //changed controller function name
Route::get('/addsme', 'SurveyController@addsme'); //Invite SME/Add Sme same changed controller function name
Route::post('/addsme', 'SurveyController@addsave'); //Invite SME/Add Sme same changed controller function name
Route::get('/editsme/{id}', 'SurveyController@editsme'); //Protection for user as can be access by both types //changed controller
Route::post('/editsme/{id}', 'SurveyController@editsave'); //Protection for user as can be access by both types //changed controller
Route::get('/viewsme/{id}', 'SurveyController@view'); //changed controller
Route::get('/infosme/{id}', 'SurveyController@info'); //changed controller
Route::post('/deletesme/{id}', 'SurveyController@deletesme'); //changed controller
Route::get('/infodatasme/{selectedid}', 'SurveyController@infodata'); //changed controller

//SMES
Route::get('/home', 'SMEController@home');
Route::get('/takesurvey/{id}', 'SMEController@takesurvey'); //changed controller
Route::get('/profile', 'SMEController@profile'); //???????
Route::get('/editprofile', 'SMEController@profile'); //???????
Route::get('/takesurveyresults/{id}', 'SMEController@graph');
Route::post('/profileedit/{id}', 'SMEController@editsave');
Route::post('/profileadd', 'SMEController@addsave');
Route::post('/emailsave', 'SMEController@emailsave');

//GUEST
Route::post('/saveanonymousresult', 'GuestController@saveanonymousresult'); 
Route::get('/takeanonymousresults/{id}', 'GuestController@graphanonymous');
Route::get('/takeanonymoussurvey/{id}', 'GuestController@takeanonymus'); 
Route::post('/emailsave', 'GuestController@emailsave');

// reports
Route::get('/reports', 'ReportController@index');
Route::get('/editreport/{id}', 'ReportController@editreport');
Route::post('/editreport/{id}', 'ReportController@saveeditedreport');
Route::get('/viewreport/{id}', 'ReportController@viewreport');
//Route::get('/viewreport/{id}', 'ReportController@reportdata');
Route::post('/deletereport/{id}', 'ReportController@deletereport');    
Route::get('/addnewreport', 'ReportController@addnewreport');
Route::post('/addnewreport', 'ReportController@savenewreport');
Route::get('/surveyresults/{id}', 'ReportController@getdata');

// Route::get('/report/{id}', 'SurveyController@reportsurvey'); //???????
Route::get('/getdata/{id}', 'SMEController@getdata'); //????????????



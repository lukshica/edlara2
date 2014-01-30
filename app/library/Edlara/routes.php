<?php
// dd($lang = substr(, 0, 2));




Route::group(["domain"=>"","prefix"=>""],function(){

Route::get('/','Edlara\Routing\HomeController@index');
Route::get('tutorials','Edlara\Routing\HomeController@tutorials');
Route::get('exams','Edlara\Routing\HomeController@exams');
Route::get('u/{profile}',"Edlara");

});

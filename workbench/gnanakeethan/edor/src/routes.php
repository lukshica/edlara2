<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>''],function(){
    Route::get('/','Gnanakeethan\Edor\Routing\HomeController@index');
});

<?php namespace Gnanakeethan\Edor\Routing;

use Illuminate\Support\Facades\View;

class HomeController extends BaseController {
    public function index(){
        return View::make('index');
    }
}
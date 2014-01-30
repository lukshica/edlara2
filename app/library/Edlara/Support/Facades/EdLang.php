<?php namespace Edlara\Support\Facades;

use Illuminate\Support\Facades\Facade;

class EdLang extends Facade {

    protected static function getFacadeAccessor(){ return "translator.edlara";}
}
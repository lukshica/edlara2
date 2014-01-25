<?php namespace Edlara\Support\Facades;

use Illuminate\Support\Facades\Facade;

class OG extends Facade {

    protected static function getFacadeAccessor(){return "opengraph";}
}
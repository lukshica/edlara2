<?php namespace Edlara\Quest\Resolver\WolframAlpha;

use Edlara\Quest\Resolver\ResolverInterface;

class Resolver implements ResolverInterface
{


    public function __construct($apikey,$url)
    {
        $this->api = new Engine\Api();
        $this->api->apikey =$apikey?:\Illuminate\Config::get("edlara.wolframalpha_key");
        $this->api->url =$url?:\Illuminate\Config::get("edlara.wolframalpha_url");
    }

    public function ask($question=null)
    {
//        $this->bot->
    }

    public function relateAuto()
    {

    }

    public function relatedTo()
    {

    }
}
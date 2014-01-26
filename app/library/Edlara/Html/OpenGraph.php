<?php namespace Edlara\Html;

use Illuminate\Html\HtmlBuilder as Html;
use Illuminate\Support\Facades\Event;

class OpenGraph{

    /**
     * Site Name
     */
    protected $sitename="Edlara";

    /**
     * HTML Object
     */
    private $html=null;

    /**
     * NameSpace
     */
    protected $og_namespace = "http://opg.me/ns";

    /**
     * Image
     */
    protected $image = "/images/logo.png";

    /**
     * Title
     */
    protected $title = "Edlara";

    public function __construct(Html $html=null){
        $this->html = isset($html)?$html:new Html;

        $this->html->macro('OpenGraph',function(
            $type=null,
            $content=null,
            $method=null,
            $additional=null ){

            if((isset($type)
                &&isset($method)
                &&isset($content)
                &&isset($additional))){

                return "<meta property='og:".$type.":".$method.":"
                    .$additional."' content='".$content."' >";
            }
            if((isset($type)
                &&isset($method)
                &&isset($content))){

                return "<meta property='og:".$type.":".
                    $method."' content='".$content."' >";
            }
            if((isset($type)
                &&isset($content))){
                return "<meta property='og:".
                    $type."' content='".$content."' >";
            }
        });
    }



    public function sitename($sitename=""){
        return $this->html->OpenGraph("site_name",$sitename?:$this->sitename);
    }

    public function base(){
        return $this->html->OpenGraph("type","website");
    }

    public function title($title=null){
        return $this->html->OpenGraph("title",$title?:$this->title);
    }

    public function author($type="article",$author=null){
        if($type=="book"){
            return $this->html->OpenGraph("book",
                    $author?:$this->author,"author");
        }
        return $this->html->OpenGraph($type,
                    $author?:$this->author,"author");
    }

    public function image($image=""){
        return $this->html->OpenGraph("image",$image?:$this->image);
    }

    public function prefix($og_namespace=""){
        $og_namespace = $og_namespace?:$this->og_namespace;
        return "prefix=\"og: ".$og_namespace."\"";
    }

    public function all(){
        $output = "";
        $output.= $this->base();
        $output.= $this->sitename();
        $output.= $this->title();
        $output.= $this->image();
        return $output;
    }

     /**
      * Magic Get Method to replace Native Access Methods
      */
     public function __get($name){
        $eventedget = Event::fire("og.".$name.".get",$this->{$name});
        $final= $eventedget[0]?:$this->{$name};
        if($name == "html"){
            return $this->{name};
        }
        else{
            return $final;
        }
     }

     /**
      * Magic Set Method to replace Native Access Methods
      */
     public function __set($name,$value=null){
        $eventedset = Event::fire("og.".$name.".set",$value);
        if(!(isset($value))){
            $value = isset($eventedset[0])?$eventedset[0]:$value;
        }
        $this->{$name}=$value?:$this->{name};
     }

}
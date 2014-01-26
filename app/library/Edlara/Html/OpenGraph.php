<?php namespace Edlara\Html;

use Illuminate\Html\HtmlBuilder as Html;
use Illuminate\Support\Facades\Event;

class OpenGraph{

    /**
     * Instance
     */
    private static $_instance;
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

    private function __construct(Html $html=null){
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
        // self::$_instance =$this;
    }
    public static function getInstance(){
        if(!is_object(self::$_instance)){
            return self::$_instance = new self;
        }
        return self::$_instance;
    }


    public function sitename($sitename=""){
        return $this->html->OpenGraph("site_name",$sitename?:self::__get('sitename'));
    }

    public function base(){
        return $this->html->OpenGraph("type","website");
    }

    public function title($title=null){
        return $this->html->OpenGraph("title",$title?:self::__get('title'));
    }

    public function author($type="article",$author=null){
        if($type=="book"){
            return $this->html->OpenGraph("book",
                    $author?:self::__get("author"),"author");
        }
        return $this->html->OpenGraph($type,
                    $author?:self::__get("author"),"author");
    }

    public function image($image=""){
        return $this->html->OpenGraph("image",$image?:self::__get('image'));
    }

    public function prefix($og_namespace=""){
        $og_namespace = $og_namespace?:self::__get('og_namespace');
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
        if($name == "html"){
            return $this->{name};
        }
        else{
            $eventedget = Event::fire("og.".$name.".get",[$this->{$name}]);
            $final= isset($eventedget[0])?$eventedget[0]:$this->{$name};
            return $final;
        }
     }

     /**
      * Magic Set Method to replace Native Access Methods
      */
     public function __set($name,$value=null){
        $eventedset = Event::fire("og.".$name.".set",[$value]);
        if(!(isset($value))){
            $value = isset($eventedset[0])?$eventedset[0]:$value;
        }
        $this->{$name}=isset($value)?$value:$this->{name};
     }

}
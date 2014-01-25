<?php namespace Edlara\Html;

use Illuminate\Html\HtmlBuilder as Html;
use Illuminate\Support\Facades\Event;

class OpenGraph extends Meta{

    /**
     * Image
     */
    protected $image = "/images/logo.png";

    public function __construct(Html $html){
        $this->html = $html?:new Html;

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

    public function author($author=null,$type="article"){
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

    public function all(){
        $output = "";
        $output.= $this->base();
        $output.= $this->sitename();
        $output.= $this->image();
        return $output;
    }

}
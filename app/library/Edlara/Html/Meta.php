<?php namespace Edlara\Html;

use Illuminate\Html\HtmlBuilder as Html;
use Illuminate\Support\Facades\Event;

class Meta {

    /**
     * Author
     */
    protected $author="Grans Group";


    /**
     * Charset
     */
    protected $charset="UTF-8";

    /**
     * Constructing the dependencies
     *
     * @param  \Illuminate\Html\HtmlBuilder
     * @return void
     */
    public function __construct(Html $html=null){
        $this->html = $html?:new Html;

        $this->html->macro('meta',function($name=null,$content=null,$http=null,$charset=null){
            if(isset($charset)): return "<meta charset=\"".$charset."\" >";
            endif;
            if(isset($name,$content)): return "<meta name='".$name."' content='".$content."' >";
            endif;
            if(isset($http,$content)): return "<meta http-equiv='".$http."' content='".$content."' >";
            endif;
        });
    }


    /**
     * Set the Default Author
     *
     * @param author
     * @return void
     */
    public function setAuthor($author="Grans Group"){
        $eventedauthor = Event::fire('meta.author', $author);
        $this->author = isset($eventedauthor[0])?$eventedauthor[0]:$author;
    }

    /**
     * Set the Default Charset
     *
     * @param String
     * @return void
     */
    public function setCharset($charset="UTF-8"){
        $eventedcharset = Event::fire('meta.charset',$charset);
        $this->charset = $eventedcharset?:$charset;
    }


    /**
     * Get the Default Author
     *
     * @return String
     */
    public function getAuthor()
    {
        $eventedauthor = Event::fire('meta.author', $this->author);
        return isset($eventedauthor[0])?$eventedauthor[0]:$this->author;
    }

    /**
     * Get the Default Charset
     *
     * @return String
     */
    public function getCharset(){
        $eventedcharset = Event::fire('meta.charset',$this->charset);
        $this->charset = $eventedcharset?:$this->charset;
        return $this->charset;
    }

    /**
     * Return the Author Meta Tag
     *
     * @return String
     */
    public function author($author=null){
        return $this->html->meta('author',isset($author)?$author:$this->author);
    }


    public function refresh($time=5){
        try {
            $isnt=is_int($time);
            if(!$isnt):throw new \Exception("Error Processing Request", 1);
            endif;
        } catch (\Exception $e) {
            return "Unable To Process Request.";
        }
        return $this->html->meta(null,$time,"refresh");
    }
}
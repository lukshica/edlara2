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
     * Description
     */
    protected $description = "Edlara Educational Package";

    /**
     * Generator
     */
    protected $generator = "Edlara";

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
     * @param String $author set the default author
     * @return void
     */
    public function setAuthor($author="Grans Group"){
        $eventedauthor = Event::fire('meta.author', $author);
        $this->author = isset($eventedauthor[0])?$eventedauthor[0]:$author;
    }

    /**
     * Set the Default Charset
     *
     * @param String $charset set the default charset
     * @return void
     */
    public function setCharset($charset="UTF-8"){
        $eventedcharset = Event::fire('meta.charset',$charset);
        $this->charset = $eventedcharset?:$charset;
    }


    /**
     * Get the Default Author
     *
     * @return String return the default author
     */
    public function getAuthor()
    {
        $eventedauthor = Event::fire('meta.author', $this->author);
        return isset($eventedauthor[0])?$eventedauthor[0]:$this->author;
    }

    /**
     * Get the Default Charset
     *
     * @return String returns the default charset
     */
    public function getCharset(){
        $eventedcharset = Event::fire('meta.charset',$this->charset);
        $this->charset = $eventedcharset[0]?:$this->charset;
        return $this->charset;
    }

    /**
     * Set the Default Description
     *
     * @param String $description The Default Description
     */
    public function setDescription($description=null)
    {
        $eventeddesc = Event::fire('meta.description',$this->description);
        $this->description = $eventeddesc[0]?:$this->description;
    }


    /**
     * Author Meta Tag
     *
     * @param String $author Set The author name Temporarily and return meta.
     * @return String the meta tag for author
     */
    public function author($author=null){
        return $this->html->meta('author',isset($author)?$author:$this->author);
    }


    /**
     * Refresh Meta Tag
     *
     * @param int $time the time in seconds.
     * @return String meta tag for refresh counted by time
     */
    public function refresh($time=5){
        $time = int ($time);
        if(!is_int($time)){
            return $this->html->meta(null,$time=5,"refresh");
        }
        return $this->html->meta(null,$time,"refresh");
    }

    /**
     * Charset Meta Tag
     *
     * @param String $charset the overriding charset
     * @return String the meta tag for charset
     */
    public function charset($charset=null){
        return $this->html->meta(null,null,null,$charset?:$this->charset);
    }

    /**
     * Description Meta tag
     *
     * @param String $description overrides
     * @return String the meta tag for description
     */
    public function description($description=null){
        return $this->html->meta('description',$description?:$this->description);
    }

    /**
     * Generator Meta tag
     *
     * @param String $generator generator override
     */
    public function generator($generator=null){
        return $this->html->meta('generator',$generator?:$this->generator);
    }
}
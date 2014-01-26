<?php namespace Edlara\Html;

use Illuminate\Html\HtmlBuilder as Html;
use Illuminate\Support\Facades\Event;

class Meta {

    /**
     * Instance
     */
    private static $_instance;

    /**
     * HTML Object
     */
    private $html;

    /**
     * Site Name
     */
    protected $sitename="Edlara";


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
     * Viewport
     */
    protected $viewport = "width=device-width, initial-scale=1.0";

    /**
     * Keywords
     */
    protected $keywords = array();

    /**
     * Constructing the dependencies
     *
     * @param  \Illuminate\Html\HtmlBuilder
     * @return void
     */
    public function __construct(Html $html=null){
        $this->html = $html?:new Html;

        $this->sitename=\Orchestra\Support\Facades\App::memory()->get("site.name", "Edlara");

        $this->html->macro('meta',function($name=null,$content=null,$http=null,$charset=null){
            if(isset($charset)): return "<meta charset=\"".$charset."\" >";
            endif;
            if(isset($name,$content)): return "<meta name='".$name."' content='".$content."' >";
            endif;
            if(isset($http,$content)): return "<meta http-equiv='".$http."' content='".$content."' >";
            endif;
        });
    }
    public function getInstance(){
        if(is_null(self::$_instance)){
            return false;
        }
        return self::$_instance;
    }


    public function removeKeyword($keyword=""){
        if(in_array($keyword, array_unique($this->keywords))){
            $pin = array_search($keyword,array_unique(($this->keywords)));
            unset($this->keywords[$pin]);
        }
    }

    /**
     * Flush the Keywords List.
     */
    public function flushKeywords(){
        $this->keywords=array();
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
        $time = (int)$time;
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


    /**
     * Viewport Meta Tag
     *
     * @param String $viewport viewport override
     */
    public function viewport($viewport=null){
        return $this->html->meta('viewport',$viewport?:$this->viewport);
    }

    /**
     * Keywords Meta Tag
     *
     * @param Array $keywords The List of Keywords to add at last
     */
    public function keywords($keywords=array()){
        $keywords = array_unique(array_merge($this->keywords,$keywords));
        return $this->html->meta('keywords',implode(',', $keywords));
    }


    /**
     * Robots Meta Tag
     *
     * @param String $option
     */
    public function robots($robots){
        return $this->html->meta('robots',$robots);
    }

    /**
     * Magic Get Method to replace Native Access Methods
     */
    public function __get($name){
        $eventedget = Event::fire("meta.".$name,$this->{$name});
        $final= $eventedget[0]?:$this->{$name};
        if($name!== "html"){
        return $this->{$name}?:$final;
        }
        else{
            return $final;
        }
    }

    /**
     * Magic Set Method to replace Native Access Methods
     */
    public function __set($name,$value=null){
        $eventedset = Event::fire("meta.".$name,$value);
        return $this->{$name}=isset($eventedset[0])?$eventedset[0]:$this->{$name};
    }
}
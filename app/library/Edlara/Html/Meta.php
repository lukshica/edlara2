<?php namespace Edlara\Html;

use Illuminate\Html\HtmlBuilder as Html;
use Illuminate\Support\Facades\Event;

class Meta {

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
        $this->charset = isset($eventedcharset[0])?$eventedcharset[0]:$this->charset;
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
        $this->description = isset($eventeddesc[0])?$eventeddesc[0]:$description;
    }

    /**
     * Get the current Description
     *
     * @return String The Current Description
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * Set the viewport config
     *
     * @param String $viewport The Default View Port
     */
    public function setViewPort($viewport=null){
        $eventedviewport = Event::fire('meta.viewport',$this->viewport);
        $this->viewport = isset($eventedviewport[0])?$eventedviewport[0]:$this->viewport;
    }

    /**
     * Append to current viewport
     *
     * @param String $viewportap The Appended String
     */
    public function appendViewPort($viewportap=""){
        $this->viewport .= $viewportap;
    }

    /**
     * Get the current viewport vars
     *
     * @return String The current Viewport config
     */
    public function getViewPort(){
        return $this->viewport;
    }


    /**
     * Set the Keywords
     *
     * @param Array $keywords The Keywords list to setup.
     * @return void
     */
    public function setKeywords($keywords=array()){
        $this->keywords = array_unique(array_merge($this->keywords,$keywords));
    }

    /**
     * Add a Keyword
     *
     * @param String $keyword Keyword to add
     * @return void
     */
    public function addKeyword($keyword=""){
        $this->keywords = array_unique(array_merge($this->keywords,[$keyword]));
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
     * Get the Keywords list
     */
    public function getKeywords(){
        return array_unique($this->keywords);
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
}
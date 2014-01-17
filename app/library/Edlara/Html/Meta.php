<?php namespace Edlara\Html;

use Illuminate\Html\HtmlBuilder as Html;

class Meta {

    /**
     * Constructing the dependencies
     *
     * @param  \Illuminate\Html\HtmlBuilder $html
     * @return void
     */
    public function __construct(Html $html){
        $this->html = $html;

        $this->html->macro('meta',function($name,$content,$http,$charset){
            if(isset($charset)): return "<meta charset=\"".$charset."\" >";
            endif;
            if(isset($name,$content)): return "<meta name='".$name."' content='".$content."' >";
            endif;
            if(isset($http,$content)): return "<meta http-equiv='".$http."' content='".$content."' >";
            endif;
        });
    }
}
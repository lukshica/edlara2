<?php namespace Edlara\Lang;

use Illuminate\Translation\Translator as Translator;
class Lang extends Translator {

    /**
     * Header
     */

    private $header;

    /**
     * Regex Filter
     */
    private $regex;

    /**
     * Acceptable Languages
     */
    private $accept = array();

    /**
     * Preferred Language
     */
    protected $preferredlang;

    /**
     * Providable Language
     */
    protected $providablelang = array();

    /**
     * Construct
     *
     * @return void;
     */
    public function __construct(){
        $this->header = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $this->setFilterRegex();
        $this->filterLanguages();
        return;
    }
    private function setFilterRegex(){
        $re1 = '([a-z]+((-|_)[A-Z]+)?)';
        $this->regex = $re1;

    }
    private function filterLanguages($filter=null){
        $filter  =$filter?:$this->header;
        preg_match_all($this->regex, $filter,$pre);
        foreach ($pre[0] as $value){
            if(strlen($value) >=2){
            $this->accept[]  = $value;
            }
        }
        //Set the Preferred language
        $this->preferredlang = isset($this->accept[0])?$this->accept[0]:"";
        return $this->accept;
    }
    private function preferredLanguage(){
        return $this->preferredlang;
    }

    private function acceptableLanguages(){
        return $this->accept;
    }

    protected function providableLanguage($string=""){
        foreach ($this->accept as $key => $value){
            $trans = \Lang::has($string,$value);
            if($trans){
                $this->providablelang[] = $value;
            }
        }
        return $this->providablelang;
    }

    public function guess($string="",array $replace = array(),$locale=null){
        $providablelang = $this->providableLanguage($string);
        foreach($providablelang as $key => $value){
            if(in_array($value ,$this->accept)){
                $locale = $locale?:$value;
                return \Lang::get($string,$replace,$locale);
            }
        }
        return \Lang::get($string);
    }

    public function get($string="",array $replace=array(),$locale=null){
        return $this->guess($string,$replace,$locale);
    }

}
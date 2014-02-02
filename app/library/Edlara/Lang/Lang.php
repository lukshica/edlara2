<?php namespace Edlara\Lang;

use Illuminate\Translation\Translator as Translator;
use Illuminate\Translation\LoaderInterface;
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
     * System language
     */
    private $lang;

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
    public function __construct(LoaderInterface $loader,$locale,$header=null){
        parent::__construct($loader,$locale);
        $this->header = $header?:$_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $this->setFilterRegex();
        $this->filterLanguages();
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

    public function providableLanguage($string=""){
        if($string !== null){
            $replace = array();
            foreach ($this->accept as $key => $locale){
                list($namespace, $group, $item) = $this->parseKey($string);
                foreach ($this->accept as $l)
                {
                    $this->load($namespace, $group, $l);

                    $line = $this->getLine(
                        $namespace, $group, $l, $item, $replace
                    );

                    if ( ! is_null($line)) break;
                }
                if($line !== $string){
                    $this->providablelang[] = $locale;
                    $this->providablelang = array_unique($this->providablelang);
                }
            }
        }
        return $this->providablelang;
    }
    public function setLang(){
        return \App::setLocale($this->preferredlang);
    }

    public function guess($string="",array $replace = array(),$locale=null){
        $this->providableLanguage($string);
        if(!empty(array_filter($this->providablelang))){
            foreach($this->providablelang as $key => $value){
                if(in_array($value ,$this->accept)){
                    foreach($this->accept as $accept){
                        if($accept === $value){
                            return parent::get($string,$replace,$value);
                        }
                    }
                }
            }
        }
        return parent::get($string,$replace,$locale);
    }

    public function get($string,array $replace=array(),$locale=null){
        return $this->guess($string,$replace,$locale);
    }

}
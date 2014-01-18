<?php

use \Mockery as m;

class MetaTest extends TestCase {

    public function after(){
        m::close();
        unset($this->mock);
    }

    public function testConstruct(){

        $this->mock =  m::mock('Illuminate\Html\HtmlBuilder');
        $this->mock->shouldReceive('macro')->once()->andReturn(null);
        $this->html = new Edlara\Html\Meta($this->mock);

    }

    public function testSetGetAuthor(){

        $this->mock = new Edlara\Html\Meta();
        $this->mock->setAuthor('Testing Author');
        $this->assertEquals($this->mock->getAuthor(),"Testing Author");

    }


    public function testSetGetAuthorWithEvent(){

        Event::listen('meta.author',function(){
            return "Testing";
        });

        $this->mock = new Edlara\Html\Meta();
        $this->mock->setAuthor("Bar");
        $this->assertNotEquals($this->mock->getAuthor(),"Bar");

    }

    public function testSetGetCharset(){

        $this->mock = new Edlara\Html\Meta();
        $this->mock->setCharset("Western");
        $this->assertEquals("Western",$this->mock->getCharset());

    }

    public function testSetGetCharsetWithEvent(){

        Event::listen("meta.charset",function(){
            return "Unicode";
        });

        $this->mock = new Edlara\Html\Meta();
        $this->mock->setCharset("US-ENC");
        $this->assertNotEquals("US-ENC",$this->mock->getCharset());
    }

    public function testAuthor(){
        $this->mock = m::mock('Illuminate\Html\HtmlBuilder');
        $this->mock->shouldReceive('macro')->once()->andReturn(null);
        $this->mock->shouldReceive('meta')->once()
            ->with('author','TestingAuthor')
            ->andReturn('<meta name=\'author\' content=\'TestingAuthor\' >');

        $this->html = new Edlara\Html\Meta($this->mock);

        $this->result=$this->html->author("TestingAuthor");
        $this->assertEquals('<meta name=\'author\' content=\'TestingAuthor\' >',
            $this->result);

    }
}
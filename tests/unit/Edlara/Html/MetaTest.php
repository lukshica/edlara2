<?php

use \Mockery as m;

class MetaTest extends TestCase {

    public function after(){
        m::close();
        unset($this->mock);
        unset($this->result);
        unset($this->html);
    }

    public function testConstruct(){

        // Mock the instance of HTMLBuilder
        $this->mock =  m::mock('Illuminate\Html\HtmlBuilder');
        // Add initial mock statement
        $this->mock->shouldReceive('macro')->once()->andReturn(null);

        // Try to create a instance of Edlara\Html\Meta with mock
        $this->html = new Edlara\Html\Meta($this->mock);

        // Assert that we do have a functional instance of Edlara\Html\Meta
        $this->assertInstanceOf('Edlara\Html\Meta',$this->html);

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

    public function testRefresh(){
        $this->mock = m::mock('Illuminate\Html\HtmlBuilder');
        $this->mock->shouldReceive('macro')->once()->andReturn(null);
        $this->mock->shouldReceive('meta')->once()
            ->with(null,'5',"refresh")
            ->andReturn('<meta http-equiv="refresh" content="5" >');

        $this->html = new Edlara\Html\Meta($this->mock);

        $this->result = $this->html->refresh(5);

        $this->assertEquals('<meta http-equiv="refresh" content="5" >',$this->result);
    }
}
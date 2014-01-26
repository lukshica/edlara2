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

    public function testGenerator(){
        $html = '<meta name="generator" content="Laravel" >';
        $this->mock = m::mock('Illuminate\Html\HtmlBuilder');
        $this->mock->shouldReceive('macro')->once()->andReturn(null);
        $this->mock->shouldReceive('meta')->once()
            ->with("generator","Laravel")
            ->andReturn($html);

        $this->html = new Edlara\Html\Meta($this->mock);
        $this->result=$this->html->generator("Laravel");

        $this->assertEquals($html,$this->result);

    }
    public function testViewport(){
        $view = "Content:34;";
        $html = '<meta name="viewport" content="'.$view.'" >';
        $this->mock = m::mock('Illuminate\Html\HtmlBuilder');
        $this->mock->shouldReceive('macro')->once()->andReturn(null);
        $this->mock->shouldReceive('meta')->once()
            ->with("viewport",$view)
            ->andReturn($html);

        $this->html = new Edlara\Html\Meta($this->mock);
        $this->result=$this->html->viewport($view);

        $this->assertEquals($html,$this->result);

    }
}
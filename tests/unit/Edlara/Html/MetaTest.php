<?php

use \Mockery as m;

class MetaTest extends TestCase {

    public function after(){
        m::close();
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


}
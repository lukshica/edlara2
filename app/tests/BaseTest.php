<?php


class BaseTest extends TestCase {

    /**
     * Initial Test to Ensure the Application is working well.
     */
    public function testIndex(){

        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}
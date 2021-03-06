<?php

namespace Api\TaurusBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

    public function testIndex() {
        $client = static::createClient();
        $client->request(
                'GET', '/taurus/index', array(), array(), array(
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
                )
        );
 

    $response = $client->getResponse();
    $this->assertSame(200, $client->getResponse()->getStatusCode()); // Test if response is OK
    $this->assertSame('application/json', $response->headers->get('Content-Type')); // Test if Content-Type is valid application/json   
    $this->assertEquals('{"application":"Taurus Api 1.0","release date":"Feb 2015","author":"Daniele Centamore","contact":"daniele.centamore@gmail.com"}', $response->getContent()); // Test if company was inserted
    $this->assertNotEmpty($client->getResponse()->getContent()); // Test that response is not empty


        $this->assertTrue(
                $client->getResponse()->headers->contains(
                        'Content-Type', 'application/json'
                )
        );
    }
    
    
    public function testVerifySecretCode() {
        $client = static::createClient();
        $client->request(
                'GET', '/taurus/verify/secret-code', array("secretcode" => "111111", "email" => "daniele.centamore@gmail.com"), array(), array(
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
                )
        );
 

    $response = $client->getResponse();
    $this->assertSame(200, $client->getResponse()->getStatusCode()); // Test if response is OK
    $this->assertSame('application/json', $response->headers->get('Content-Type')); // Test if Content-Type is valid application/json
    $this->assertEquals('Pavia', substr($response->getContent(),count($response->getContent())-16,5)); // Test if company was inserted
    $this->assertNotEmpty($client->getResponse()->getContent()); // Test that response is not empty


        $this->assertTrue(
                $client->getResponse()->headers->contains(
                        'Content-Type', 'application/json'
                )
        );
    }
    
    
    public function testVeryfyAuthorizationCode() {
        $client = static::createClient();
        $client->request(
                'GET', '/taurus/verify/authorization-code', array("secretcode" => "111111", "authCode" => "999999999999", "transactionID" => "cf06eb7e8ea609b94f1474a8365d2afe-4560"), array(), array(
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
                )
        ); 

    $response = $client->getResponse();
    $this->assertSame(200, $client->getResponse()->getStatusCode()); // Test if response is OK
    $this->assertSame('application/json', $response->headers->get('Content-Type')); // Test if Content-Type is valid application/json
    $this->assertEquals('{"response":"error"}', $response->getContent()); // Test if company was inserted
    $this->assertNotEmpty($client->getResponse()->getContent()); // Test that response is not empty


        $this->assertTrue(
                $client->getResponse()->headers->contains(
                        'Content-Type', 'application/json'
                )
        );
    }
    
    public function testExecuteTransaction() {
        $client = static::createClient();
        $client->request(
                'GET', '/taurus/execute/transaction', array("secretcode" => "111111","beneficiaryname" => "Daniele Centamore", "beneficiaryaccount" => "IT000000000000000000000000002333", "orderamount" => "123.00","banknote" => "fattura: 234","transactionID" => "cf06eb7e8ea609b94f1474a8365d2afe-4560"), array(), array(
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X-Requested-With' => 'XMLHttpRequest',
                )
        ); 

    $response = $client->getResponse();
    $this->assertSame(200, $client->getResponse()->getStatusCode()); // Test if response is OK
    $this->assertSame('application/json', $response->headers->get('Content-Type')); // Test if Content-Type is valid application/json
    $this->assertEquals('{"response":"error"}', $response->getContent()); // Test if company was inserted
    $this->assertNotEmpty($client->getResponse()->getContent()); // Test that response is not empty


        $this->assertTrue(
                $client->getResponse()->headers->contains(
                        'Content-Type', 'application/json'
                )
        );
    }
    
    

}

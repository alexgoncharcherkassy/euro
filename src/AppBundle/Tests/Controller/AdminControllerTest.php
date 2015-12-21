<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 05.12.15
 * Time: 12:15
 */

namespace AppBundle\Tests\Controller;


use AppBundle\Tests\TestBaseWeb;
//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends TestBaseWeb
{
    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Admin', $crawler->filter('body')->text());

    }

    public function testInsertTeam()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/insert/team/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Team', $crawler->filter('body')->text());

    }

    public function testInsertCountry()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/insert/country/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('country', $crawler->filter('body')->text());

    }

    public function testInsertCoach()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/insert/coach/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Coach', $crawler->filter('body')->text());

    }

    public function testInsertPlayer()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/insert/player/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Player', $crawler->filter('body')->text());

    }

    public function testInsertGame()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/insert/game/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Game', $crawler->filter('body')->text());

    }

    public function testDeleteElementsTeam()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin/delete/team/elements/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Elements', $crawler->filter('body')->text());

    }

}


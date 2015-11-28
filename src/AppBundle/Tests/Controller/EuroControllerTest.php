<?php
/**
 * Created by PhpStorm.
 * User: device
 * Date: 19.11.15
 * Time: 18:44
 */

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EuroControllerTest extends WebTestCase
{
    public function testShowTeam()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/1');
        $this->assertContains('Country:', $crawler->filter('body')->text());
    }

    public function testShowCountry()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/1/description');
        $this->assertContains('Country:', $crawler->filter('body')->text());
    }

    public function testShowCoach()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/coaches/1');
        $this->assertContains('Coach:', $crawler->filter('body')->text());

    }

    public function testShowPlayer()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/players/1');
        $this->assertContains('Player:', $crawler->filter('body')->text());

    }

    public function testShowMatch()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/matches/0');
        $this->assertContains('Matches', $crawler->filter('body')->text());

    }

}


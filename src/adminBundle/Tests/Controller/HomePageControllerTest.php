<?php

namespace adminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testCreateuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/users/create');
    }

    public function testUser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/users/{id}');
    }

    public function testEdituser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/users/{id}/edit');
    }

    public function testDeleteuser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/users/{id}/delete');
    }

}

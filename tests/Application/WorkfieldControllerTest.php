<?php

declare(strict_types=1);

namespace App\Tests\Application;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WorkfieldControllerTest extends WebTestCase
{
    #[Test]
    public function it_can_access_workfield(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/workfield');

        self::assertResponseIsSuccessful();
    }
}

<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use App\Downloader\Downloader;
use Mockery;
use PHPUnit\Framework\TestCase;
use App\Parser\Parser;
use Generator;

class DownloaderTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /** @test */
    public function test_get_contents()
    {
        $body = 'Lorem ipsum dolor';
        $headers = [
            ['lorem' => 'ipsum'],
            ['dolor' => 'sit amet'],
        ];
        $mock = new MockHandler([new Response(200, $headers, $body)]);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $downloader = new Downloader(['/'], $client);
        $response = $downloader->getContents()->current();
        $this->assertEquals($body, $response);
    }
}
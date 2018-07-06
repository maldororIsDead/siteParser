<?php

namespace App\Downloader;
use Generator;
use GuzzleHttp\ClientInterface;

class Downloader implements DownloaderInterface
{
    /** @var ClientInterface */
    protected $client;

    public function __construct(ClientInterface $client)
    {
       $this->client = $client;
    }

    public function download(array $links): Generator
    {
        foreach ($links as $url) {
            $data = $this->client->request('GET', $url);
            yield $data->getBody();
        }
    }
}
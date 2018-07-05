<?php

namespace App\Downloader;
use Generator;
use GuzzleHttp\ClientInterface;

class Downloader implements DownloaderInterface
{
    /** @var ClientInterface */
    protected $client;

    /* @var array */
    protected $links;

    public function __construct(array $links, ClientInterface $client)
    {
       $this->client = $client;
       $this->links = $links;
    }

    public function getContents(): Generator
    {
        foreach ($this->links as $url) {
            $data = $this->client->request('GET', $url);
            yield $data->getBody();
        }
    }
}
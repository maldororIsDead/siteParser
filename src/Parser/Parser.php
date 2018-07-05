<?php

namespace App\Parser;

use GuzzleHttp\Client;

use Generator;
use GuzzleHttp\ClientInterface;


class Parser
{
    /* @var array */
    protected $links;

    /** @var ClientInterface */
    protected $client;

    private function getContent(): Generator
    {
        foreach ($this->links as $url) {
            $data = $this->client->get($url);
            yield $data->getBody();
        }
    }

    public function __construct(array $links, ClientInterface $client)
    {
        $this->links = $links;
        $this->client = $client;
    }

    public function getMetaInformation(): Generator
    {
        $pattern = '/\<meta.*"(?P<prop>.*)".*"(?P<value>.*)"[^>]*>/';

        foreach ($this->getContent() as $index => $value) {
            preg_match_all($pattern, $value, $matches);
            yield ([$this->links[$index] => array_combine($matches['prop'], $matches['value'])]);
        }
    }

    public function getTagContent($tag): Generator
    {
        $pattern = '/<' . $tag . '[^>]*>(?P<value>.*)<\/' . $tag . '>/';

        foreach ($this->getContent() as $index => $value) {
            preg_match_all($pattern, $value, $matches);
            yield ([$this->links[$index] => $matches['value']]);
        }
    }
}
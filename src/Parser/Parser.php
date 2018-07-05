<?php

namespace App\Parser;

use GuzzleHttp\Client;

use Generator;

class Parser
{
    /* @var array */
    protected $links;

    private function getContent(): Generator
    {
        $client = new Client;
        foreach ($this->links as $url) {
            $data = $client->get($url);
            yield $data->getBody();
        }
    }

    public function __construct(array $links)
    {
       $this->links = $links;
    }

    public function getMetaInformation(): Generator
    {
        $pattern = '/\<meta.*"(?P<prop>.*)".*"(?P<value>.*)"[^>]*>/';

        $content = $this->getContent();

        foreach ($content as $index => $value) {
            preg_match_all($pattern, $value, $matches);
            yield ([$this->links[$index] => array_combine($matches['prop'], $matches['value'])]);
        }
    }

    public function getTagContent($tag): Generator
    {
        $pattern = '/<' . $tag . '[^>]*>(?P<value>.*)<\/' . $tag . '>/';

        $content = $this->getContent();

        foreach ($content as $index => $value) {
            preg_match_all($pattern, $value, $matches);
            yield ([$this->links[$index] => $matches['value']]);
        }
    }
}
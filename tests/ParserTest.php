<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Parser\Parser;
use Generator;
use GuzzleHttp\Client;

class ParserTest extends TestCase
{
    /** @test */
    public function test_get_meta_information()
    {
        $links = [
            'vp.donetsk.ua',
        ];

        $parser = new Parser($links, new Client);

        $content = $parser->getMetaInformation();

        foreach ($content as $value) {
            $this->assertInternalType('array', $value);
            $this->assertFalse(empty($value));
        }

    }

    /** @test */
    public function test_get_tag_content()
    {
        $links = [
            'http://friend-kramatorsk.store/',
        ];

        $parser = new Parser($links,  new Client);

        $content = $parser->getTagContent('h1');

        foreach ($content as $value) {
            $this->assertInternalType('array', $value);
            $this->assertFalse(empty($value));
        }
    }
}
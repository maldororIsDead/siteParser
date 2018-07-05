<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Parser\Parser;


class ParserTest extends TestCase
{
    /** @test */
    public function get_meta_information()
    {
        $content = '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $parser = new Parser((string)$content);
        $this->assertCount(1, $parser->getMetaInformation());
    }

    /** @test */
    public function get_tag_content()
    {
        $content = '<ul>' . PHP_EOL . '<li>Laravel</li> ' . PHP_EOL . '<li>Zend</li> ' . PHP_EOL . '</ul>';
        $parser = new Parser((string)$content);
        $this->assertCount(2, $parser->getTagContent('li'));
    }
}
<?php

namespace Tests;

use App\Parser\Parser;
use PHPUnit\Framework\TestCase;
use Mockery;

class ParserTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /** @test */
    public function get_meta_information()
    {
        $content = '<meta http-equiv="X-UA-Compatible" content="IE=edge">';

        $parser = new Parser((string)$content);

        $this->assertEquals(['X-UA-Compatible' => 'IE=edge'], $parser->getMetaInformation());
    }

    /** @test */
    public function get_tag_content()
    {
        $content = '<ul>' . PHP_EOL . '<li>Laravel</li> ' . PHP_EOL . '<li>Zend</li> ' . PHP_EOL . '</ul>';

        $parser = new Parser((string)$content);

        $this->assertEquals(['Laravel', 'Zend'], $parser->getTagContent('li'));
    }

}
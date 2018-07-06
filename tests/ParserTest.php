<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Parser\Parser;
use Mockery;

class ParserTest extends TestCase
{
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    /** @test */
    public function get_meta_information()
    {
        $content = '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $service = Mockery::mock(Parser::class);
        $service->shouldReceive('getMetaInformation')
            ->andReturn(['X-UA-Compatible' => 'IE=edge']);
        $parser = new Parser((string)$content);
        $this->assertEquals(['X-UA-Compatible' => 'IE=edge'], $parser->getMetaInformation());
    }

    /** @test */
    public function get_tag_content()
    {
        $content = '<ul>' . PHP_EOL . '<li>Laravel</li> ' . PHP_EOL . '<li>Zend</li> ' . PHP_EOL . '</ul>';
        $service = Mockery::mock(Parser::class);
        $service->shouldReceive('getTagContent(\'li\')')
            ->andReturn(['Laravel', 'Zend']);
        $parser = new Parser((string)$content);
        $this->assertEquals(['Laravel', 'Zend'], $parser->getTagContent('li'));
    }

}
<?php

namespace App\Parser;

class Parser implements MetaTagParserInterface, TagParserInterface
{

    const PATTERN_META = '/\<meta.*"(?P<prop>.*)".*"(?P<value>.*)"[^>]*>/';
    const PATTERN_TAG = '/<%s[^>]*>(?P<value>.*)<\/%s>/';

    /* @var string */
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getMetaInformation(): array
    {
        preg_match_all(self::PATTERN_META, $this->content, $matches);

        return array_combine($matches['prop'], $matches['value']);
    }

    public function getTagContent(string $tag): array
    {
        preg_match_all(sprintf(self::PATTERN_TAG, $tag, $tag), $this->content, $matches);

        return $matches['value'];
    }
}
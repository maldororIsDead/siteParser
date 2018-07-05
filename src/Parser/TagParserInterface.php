<?php

namespace App\Parser;

interface TagParserInterface
{
    public function getTagContent(string $tag): array;
}
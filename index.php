<?php

require __DIR__ . '/vendor/autoload.php';

use App\Parser\Parser;
use GuzzleHttp\Client;

$links = [
    'friend-kramatorsk.store',
    'vp.donetsk.ua',
    'kramatorsk.info'
];


$parser = new Parser($links, new Client);

$content = $parser->getMetaInformation();

foreach ($content as $value) {
    var_dump($value);
}

$content = $parser->getTagContent('h1');

foreach ($content as $value) {
    var_dump($value);
}

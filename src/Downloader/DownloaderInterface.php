<?php

namespace App\Downloader;
use Generator;

interface DownloaderInterface
{
    public function download(array $links): Generator;
}
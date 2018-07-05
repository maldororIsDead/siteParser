<?php

namespace App\Downloader;
use Generator;

interface DownloaderInterface
{
    public function getContents(): Generator;
}
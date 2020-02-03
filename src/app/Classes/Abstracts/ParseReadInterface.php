<?php

namespace App\Classes\Abstracts;

use App\Exceptions\CliException;

interface ParseReadInterface
{
    /**
     * @param string $agv
     * @return string
     * @throws CliException
     */
    public function getContent($agv): string;
}
<?php

namespace App\Classes\Abstracts;

use App\Exceptions\CliException;

interface ParseInterface
{
    /**
     * @param string $arg
     * @return array
     * @throws CliException
     */
    public function make($arg): array;

    /**
     * @param string $link
     * @param string $html
     */
    public function collect($link, $html): void;

}
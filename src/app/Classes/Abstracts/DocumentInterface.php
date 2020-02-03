<?php

namespace App\Classes\Abstracts;

use App\Exceptions\CliException;

interface DocumentInterface
{
    /**
     * @param string $arg
     * @throws CliException
     */
    public function make($arg): void;
}
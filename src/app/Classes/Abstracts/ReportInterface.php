<?php

namespace App\Classes\Abstracts;

use App\Exceptions\CliException;

interface ReportInterface
{
    /**
     * @param string $arg
     * @return void
     * @throws CliException
     */
    public function make($arg): void;
}
<?php

namespace App\Classes\Concret;

use App\Classes\Abstracts\ParseInterface;
use App\Classes\Abstracts\ReportInterface;
use App\Exceptions\CliException;

class Report implements ReportInterface
{

    /**
     * @var ParseInterface
     */
    protected $parse;

    /**
     * Report constructor.
     *
     * @param ParseInterface $parse
     */
    public function __construct(ParseInterface $parse)
    {
        $this->parse = $parse;
    }

    /**
     * @param string $arg
     * @return void
     * @throws CliException
     */
    public function make($arg): void
    {
        $content = $this->parse->make($arg);

        foreach ($content as $k => $item) {
            echo "$k\n\r";
            foreach ($item as $value) {
                echo "\t$value\n\r";
            }
        }
    }
}
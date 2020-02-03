<?php

namespace App\Classes\Concret;

use App\Classes\Abstracts\DocumentInterface;
use App\Classes\Abstracts\ParseInterface;
use App\Exceptions\CliException;

class Document implements DocumentInterface
{

    /**
     * @var ParseInterface
     */
    protected $parse;

    /**
     * Document constructor.
     *
     * @param ParseInterface $parse
     */
    public function __construct(ParseInterface $parse)
    {
        $this->parse = $parse;
    }

    /**
     * @param string $arg
     * @throws CliException
     */
    public function make($arg): void
    {
        $content = $this->parse->make($arg);

        $fileName = 'file/report' . time() . '.csv';

        $fp = fopen(ROOT_DIR . $fileName, 'w');

        fputcsv($fp, ['link', 'image']);

        foreach ($content as $k => $item) {
            fputcsv($fp, [$k, '']);

            foreach ($item as $value) {
                fputcsv($fp, ['', $value]);
            }
        }

        foreach ($content as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);

        echo ROOT_DIR . $fileName . "\r\n";
    }
}
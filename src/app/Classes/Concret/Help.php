<?php

namespace App\Classes\Concret;

use App\Classes\Abstracts\HelpInterface;

class Help implements HelpInterface
{

    /**
     * @return void
     */
    public function make(): void
    {
        echo "'parse [url]' - save document \n\r";
        echo "'report [url]' - print report \n\r";
        echo "'help' - print helpers \n\r";
    }
}
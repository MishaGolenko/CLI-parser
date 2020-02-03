<?php

namespace App\Classes\Concret;

use App\Classes\Abstracts\FindLinkInterface;

class FindLink implements FindLinkInterface
{

    /**
     * @param string $html
     * @return array
     */
    public function find($html): array
    {
        preg_match_all('/href="([^"]+)"/', $html, $media);

        return preg_replace('/(a|href)("|\'|="|=\')(.*)/i', "$3", $media[0]);
    }
}
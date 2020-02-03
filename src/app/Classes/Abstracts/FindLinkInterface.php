<?php

namespace App\Classes\Abstracts;

interface FindLinkInterface
{
    /**
     * @param string $html
     * @return array
     */
    public function find($html): array;
}
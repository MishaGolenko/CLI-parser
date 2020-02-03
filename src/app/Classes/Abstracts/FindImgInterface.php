<?php

namespace App\Classes\Abstracts;

interface FindImgInterface
{
    /**
     * @param string $html
     * @return array
     */
    public function find($html): array;
}
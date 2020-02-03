<?php

namespace App\Classes\Concret;

use App\Classes\Abstracts\FindImgInterface;

class FindImg implements FindImgInterface
{

    /**
     * @param string $html
     * @return array
     */
    public function find($html): array
    {
        $images = [];

        preg_match_all('/(img|src)=("|\')[^"\'>]+/i', $html, $media);


        $data = preg_replace('/(img|src)("|\'|="|=\')(.*)/i', "$3", $media[0]);

        foreach ($data as $url) {
            $info = pathinfo($url);
            if (isset($info['extension'])) {
                if (($info['extension'] == 'jpg') ||
                    ($info['extension'] == 'jpeg') ||
                    ($info['extension'] == 'png')) {
                    array_push($images, $url);
                }
            }
        }

        return $images;
    }
}
<?php

namespace App\Classes\Concret;

use App\Classes\Abstracts\ParseReadInterface;
use App\Exceptions\CliException;

class ParseRead implements ParseReadInterface
{

    /**
     * @param string $agv
     * @return string
     * @throws CliException
     */
    public function getContent($agv): string
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $agv);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if (strpos($agv, "https") !== false) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }

        $html = curl_exec($ch);

        if ($html === false) {
            throw new CliException(curl_error($ch));
        }

        curl_close($ch);

        return $html;
    }
}
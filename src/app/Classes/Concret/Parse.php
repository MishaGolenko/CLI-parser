<?php

namespace App\Classes\Concret;

use App\Classes\Abstracts\FindImgInterface;
use App\Classes\Abstracts\FindLinkInterface;
use App\Classes\Abstracts\ParseInterface;
use App\Classes\Abstracts\ParseReadInterface;
use App\Exceptions\CliException;

class Parse implements ParseInterface
{

    /**
     * @var ParseReadInterface
     */
    protected $read;

    /**
     * @var FindImgInterface
     */
    protected $findImg;

    /**
     * @var FindLinkInterface
     */
    protected $findLink;

    /**
     * @var array
     */
    protected $content;

    /**
     * Parse constructor.
     *
     * @param ParseReadInterface $read
     * @param FindImgInterface $findImg
     * @param FindLinkInterface $findLink
     */
    public function __construct(
        ParseReadInterface $read,
        FindImgInterface $findImg,
        FindLinkInterface $findLink
    ) {
        $this->read = $read;
        $this->findImg = $findImg;
        $this->findLink = $findLink;
        $this->content = [];
    }

    /**
     * @param string $arg
     * @return array
     */
    public function make($arg): array
    {
        try {
            $domain = parse_url($arg, PHP_URL_HOST);

            $html = $this->read->getContent($arg);

            $this->collect($arg, $html);

            $links = $this->findLink->find($html);

            foreach ($links as $link) {
                if ($domain === parse_url($link, PHP_URL_HOST)) {
                    $html = $this->read->getContent($link);
                    $this->collect($link, $html);
                }
            }

            return $this->content;
        } catch (CliException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    /**
     * @param string $link
     * @param string $html
     */
    public function collect($link, $html): void
    {
        $images = $this->findImg->find($html);

        $this->content[$link] = $images;
    }
}
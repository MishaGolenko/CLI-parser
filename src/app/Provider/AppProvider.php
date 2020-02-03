<?php

namespace App\Provider;

use App\Classes\Abstracts\DocumentInterface;
use App\Classes\Abstracts\FindImgInterface;
use App\Classes\Abstracts\FindLinkInterface;
use App\Classes\Abstracts\HelpInterface;
use App\Classes\Abstracts\ParseReadInterface;
use App\Classes\Abstracts\ReportInterface;
use App\Classes\Concret\Document;
use App\Classes\Concret\FindImg;
use App\Classes\Concret\FindLink;
use App\Classes\Concret\Help;
use App\Classes\Concret\Parse;
use App\Classes\Abstracts\ParseInterface;
use App\Classes\Concret\ParseRead;
use App\Classes\Concret\Report;

class AppProvider
{

    public static  $map = [
        'Interface' => 'Class'
    ];

    /**
     * @param string $class
     */
    public static function make($class)
    {
        if (isset(self::$map[$class])) {
            $var = self::$map[$class];
            return $var();
        } else {
            return new $class();
        }
    }

    /**
     * @param string $interface
     * @param string $callback
     * @return void
     */
    public static function bind($interface, $callback): void
    {
        self::$map[$interface] = $callback;
    }

    /**
     * @return void
     */
    public function init(): void
    {
        AppProvider::bind(
            HelpInterface::class,
            function () {
                return new Help();
            }
        );

        AppProvider::bind(
            ParseReadInterface::class,
            function () {
                return new ParseRead();
            }
        );

        AppProvider::bind(
            FindImgInterface::class,
            function () {
                return new FindImg();
            }
        );

        AppProvider::bind(
            FindLinkInterface::class,
            function () {
                return new FindLink();
            }
        );

        AppProvider::bind(
            ParseInterface::class,
            function () {
                return new Parse(
                    AppProvider::make(ParseReadInterface::class),
                    AppProvider::make(FindImgInterface::class),
                    AppProvider::make(FindLinkInterface::class)
                );
            }
        );

        AppProvider::bind(
            DocumentInterface::class,
            function () {
                return new Document(AppProvider::make(ParseInterface::class));
            }
        );

        AppProvider::bind(
            ReportInterface::class,
            function () {
                return new Report(AppProvider::make(ParseInterface::class));
            }
        );
    }

}
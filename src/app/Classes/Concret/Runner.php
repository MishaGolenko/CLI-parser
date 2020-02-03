<?php

namespace App\Classes\Concret;

use App\Classes\Abstracts\DocumentInterface;
use App\Classes\Abstracts\HelpInterface;
use App\Classes\Abstracts\ReportInterface;
use App\Exceptions\CliException;
use App\Provider\AppProvider;

class Runner
{
    /**
     * @var DocumentInterface
     */
    protected $document;

    /**
     * @var ReportInterface
     */
    protected $report;

    /**
     * @var HelpInterface
     */
    protected $help;

    public function make(): void
    {
        while (1) {
            try {
                echo "Enter command\n\r";
                $handle = fopen("php://stdin", "r");
                $line = trim(fgets($handle));
                $command = stristr($line, ' ', true);
                if (!$command) {
                    $command = $line;
                }
                $arg = trim(stristr($line, ' '));
                switch ($command) {
                    case 'parse':
                        $this->document($arg);
                        break;
                    case 'report':
                        $this->report($arg);
                        break;
                    case 'help':
                        $this->help();
                        break;
                    default:
                        echo "Not valid command\n\r";
                }
            } catch (CliException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    /**
     * @param string $arg
     * @return void
     * @throws CliException
     */
    public function document($arg): void
    {
        if (!$this->document) {
            $this->document = AppProvider::make(DocumentInterface::class);
        }

        $this->document->make($arg);
    }

    /**
     * @param string $arg
     * @return void
     * @throws CliException
     */
    public function report($arg): void
    {
        if (!$this->report) {
            $this->report = AppProvider::make(ReportInterface::class);
        }

        $this->report->make($arg);
    }

    /**
     * @return void
     */
    public function help(): void
    {
        if (!$this->help) {
            $this->help = AppProvider::make(HelpInterface::class);
        }

        $this->help->make();
    }
}
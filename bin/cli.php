<?php

require __DIR__ . '/../vendor/autoload.php';

define("ROOT_DIR", __DIR__ . '/../');

use App\Provider\AppProvider;
use App\Classes\Concret\Runner;

(new AppProvider)->init();

$runner = AppProvider::make(Runner::class);

$runner->make();

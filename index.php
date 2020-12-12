<?php

use Performing\Wait\Spinner;

require __DIR__ . '/vendor/autoload.php';

spinner()->start();

sleep(2);

spinner()->update('Almost done');

sleep(2);

spinner()->stop();

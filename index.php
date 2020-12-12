<?php

use Performing\Wait\Spinner;

require __DIR__ . '/vendor/autoload.php';

wait('I am busy...',function(Spinner $spinner) {
    sleep(2);

    $spinner->update('one sec...');

    sleep(2);
});


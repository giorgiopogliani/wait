<?php

use Performing\Wait\Spinner;

require __DIR__ . '/vendor/autoload.php';

wait('I am busy...',function(Spinner $spinner) {
    sleep(2);

    $spinner->update('Almost done...');

    sleep(2);

    $spinner->update('Completed...');
});

wait('Starting another task...',function(Spinner $spinner) {
    sleep(2);

    $spinner->update('Almost done...');

    sleep(2);

    $spinner->update('Completed...');
});

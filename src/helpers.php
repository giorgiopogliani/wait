<?php

use Performing\Wait\Spinner;

if (! function_exists('wait')) {
    function wait(string $message, Closure $closure)
    {
        $spinner = Spinner::create();

        $spinner->update($message);

        $spinner->task(function () use ($closure, $spinner) {
            call_user_func($closure, $spinner);
        });
    }
}

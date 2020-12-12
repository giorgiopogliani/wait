<?php

use Performing\Wait\Spinner;

if (! function_exists('wait')) {
    function wait(string $message, Closure $closure)
    {
        $spinner = Spinner::create();

        $spinner->update($message);

        $spinner->start();

        $data = call_user_func($closure, $spinner);

        $spinner->stop();

        return $data;
    }
}

if (! function_exists('spinner')) {
    function spinner()
    {
        static $spinner;

        $spinner ??= Spinner::create();

        return $spinner;
    }
}

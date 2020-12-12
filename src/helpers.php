<?php

use Performing\Wait\Spinner;

if (! function_exists('wait')) {
    function wait(string $message, Closure $closure)
    {
        $spinner = Spinner::create();

        $spinner->update($message);

        return $spinner->task(function () use ($closure, $spinner) {
            return call_user_func($closure, $spinner);
        });
    }
}

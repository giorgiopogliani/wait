<?php

namespace Performing\Wait;

class Spinner
{
    protected $frames = ["⠋", "⠙", "⠹", "⠸", "⠼", "⠴", "⠦", "⠧", "⠇", "⠏"];

    protected $fork;

    protected $running = false;

    public function __construct()
    {
        $this->fork = Fork::create();
    }

    public static function create()
    {
        return new static;
    }

    public function update($message)
    {
        $this->message = $message;

        if ($this->running) {
            $this->done();
            $this->start();
        }
    }

    protected function start()
    {
        $this->fork->process([$this->message, $this->frames], function ($message, $frames) {
            $handle = fopen('php://output', 'w');

            fwrite($handle, "\u{001B}[?25l");

            while (true) {
                usleep(1000000 / 30);

                fflush($handle);

                fwrite($handle, "\r");

                fwrite($handle,  current($frames) . ' ' . $message);

                next($frames);

                if (! current($frames)) {
                    reset($frames);
                }
            }

            fclose('php//output');
        });
    }

    public function task($callable)
    {
        $this->running = true;

        $this->start();

        $callable();

        $this->running = false;

        $this->done();

        return $this;
    }

    protected function done()
    {
        $this->fork->terminate();

        $handle = fopen('php://output', 'w');

        fflush($handle);

        fwrite($handle, "\r");

        fwrite($handle, "✓ $this->message");

        fclose($handle);
    }
}

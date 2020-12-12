<?php

namespace Performing\Wait;

class Spinner
{
    protected $frames;

    protected $fork;

    protected $running = false;

    public function __construct($frames = ["⠋", "⠙", "⠹", "⠸", "⠼", "⠴", "⠦", "⠧", "⠇", "⠏"])
    {
        $this->frames = $frames;

        $this->fork = Fork::create();
    }

    public static function create()
    {
        return new static;
    }

    public function update($message)
    {
        if ($this->running) {
            $this->stop();
            $this->cleanup();
        }

        $this->message = $message;

        if ($this->running) {
            $this->start();
        }
    }

    protected function start()
    {
        $this->fork->process([$this->message, $this->frames], function ($message, $frames) {
            while (true) {
                usleep(1000000 / 24);

                echo "\r".(str_repeat(' ', strlen($message)));

                echo "\r".(current($frames) . ' ' . $message);

                next($frames);

                if (! current($frames)) {
                    reset($frames);
                }
            }
        });
    }

    public function task($callable)
    {
        // set running
        $this->running = true;

        // start the spinner inside the fork
        $this->start();

        // run the task
        $data = $callable();

        // stop the spinner
        $this->stop();

        // set not running
        $this->running = false;

        // set complete message
        $this->complete();

        // return data
        return $data;
    }

    public function cleanup()
    {
        echo "\r" . str_repeat(' ', mb_strlen($this->message) + 16);
    }

    protected function complete()
    {
        echo "\r" . "✓ $this->message" . PHP_EOL;
    }

    protected function stop()
    {
        $this->fork->terminate();
    }
}

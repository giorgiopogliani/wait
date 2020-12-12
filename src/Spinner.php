<?php

namespace Performing\Wait;

class Spinner
{
    protected $type;

    protected $fork;

    protected $running = false;

    protected $message = '';

    public function __construct($type = Dots::class)
    {
        $this->type = $type;
        $this->fork = Fork::create();
    }

    public static function create()
    {
        return new static;
    }

    public function update($message)
    {
        if ($this->running) {
            $this->terminate();
            $this->cleanup();
        }

        $this->message = $message;

        if ($this->running) {
            $this->run();
        }
    }

    public function start()
    {
        $this->running = true;
        $this->run();
    }

    public function stop()
    {
        $this->terminate();
        $this->running = false;
        $this->complete();
    }

    protected function run()
    {
        $this->fork->process([$this->message, $this->type], function ($message, $type) {
            foreach (new $type as $frame) {
                if (! empty($frame)) {
                    usleep(1000000 / 24);
                    echo(str_repeat(' ', strlen($message)) . "\r");
                    echo "\r$frame $message";
                }
            }
        });
    }

    protected function cleanup()
    {
        echo "\r" . str_repeat(' ', mb_strlen($this->message) + 16);
    }

    protected function complete()
    {
        echo "\r" . "✓ $this->message" . PHP_EOL;
    }

    protected function terminate()
    {
        $this->fork->terminate();
    }
}

<?php

namespace Performing\Wait;

use Exception;

class Fork
{
    public int $pid;

    protected $callback;

    public static function create()
    {
        return new static;
    }

    public function process(array $args, $callable)
    {
        if (-1 === ($this->pid = pcntl_fork())) {
            throw new Exception('Unable to fork a new process.');
        }

        if (0 === $this->pid) {
            try {
                $result = call_user_func($callable, ...$args);
                $status = is_integer($result) ? $result : 0;
            } catch (Exception $exception) {
                $status = 1;
            }

            exit($status);
        }

        return $this;
    }

    public function terminate()
    {
        posix_kill($this->pid, SIGTERM);
    }
}

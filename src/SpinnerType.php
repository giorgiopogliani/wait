<?php

namespace Performing\Wait;

use Iterator;

abstract class SpinnerType implements Iterator
{
    protected $frames;

    public function current()
    {
        return current($this->frames);
    }

    public function next()
    {
        if (! current($this->frames)) {
            reset($this->frames);

            next($this->frames);
        }

        next($this->frames);
    }

    public function key()
    {
        return key($this->frames);
    }

    public function valid()
    {
        return true;
    }

    public function rewind()
    {
        prev($this->frames);
    }
}

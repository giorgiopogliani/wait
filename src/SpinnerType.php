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
<<<<<<< HEAD
        if (!current($this->frames)) {
=======
        if (! current($this->frames)) {
>>>>>>> cc6cfd0af6b345ac7451e84e0df74e0417f71fb7
            reset($this->frames);
            return;
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

<?php

namespace tomtomsen\Iterators;

use tomtomsen\Iterators\IteratorIterator;

/**
 * @see http://php.net/manual/en/class.norewinditerator.php
 */
class NoRewindIterator extends IteratorIterator
{
    public function __construct(\Iterator $iterator)
    {
        parent::__construct($iterator);
    }

    public function rewind()
    {
    }
}

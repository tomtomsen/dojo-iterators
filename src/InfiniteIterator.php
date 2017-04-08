<?php

namespace tomtomsen\Iterators;

/**
 * Implementation of the SPL InfiniteIterator class.
 *
 * @link http://php.net/manual/class.infiniteiterator.php Documentation of SPL InfiniteIterator
 */
class InfiniteIterator extends IteratorIterator implements \OuterIterator
{
    public function __construct(\Iterator $iterator)
    {
        parent::__construct($iterator);
    }

    public function next()
    {
        if (!parent::valid()) {
            parent::rewind();
        }
    }
}

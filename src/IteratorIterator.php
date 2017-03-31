<?php

namespace tomtomsen\Iterators;

class IteratorIterator implements \OuterIterator
{
    private $iterator;

    public function __construct(\Traversable $iterator)
    {
        $this->iterator = $iterator;
    }

    public function current() /* : mixed  */
    {
        try {
            return $this->iterator->current();
        } catch (\BadMethodCallException $ex) {
            return null;
        }
    }

    public function getInnerIterator() /* : Traversable  */
    {
        return $this->iterator;
    }

    public function key() /* : scalar  */
    {
        return $this->iterator->key();
    }

    public function next() /* : void  */
    {
        $this->iterator->next();
    }

    public function rewind() /* : void  */
    {
        $this->iterator->rewind();
    }

    public function valid() /* : bool  */
    {
        return $this->iterator->valid();
    }
}

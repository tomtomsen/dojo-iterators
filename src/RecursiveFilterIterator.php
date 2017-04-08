<?php

namespace tomtomsen\Iterators;

abstract class RecursiveFilterIterator extends \FilterIterator implements \OuterIterator, \RecursiveIterator
{
    private $iterator;

    public function __construct(\RecursiveIterator $iterator)
    {
        $this->iterator = $iterator;

        parent::__construct($iterator);
    }

    public function getChildren()
    {
        return new static($this->iterator->getChildren());
    }

    public function hasChildren()
    {
        return $this->iterator->hasChildren();
    }
}

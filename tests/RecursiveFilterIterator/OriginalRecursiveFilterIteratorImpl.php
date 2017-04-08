<?php

namespace tomtomsen\Iterators\tests\RecursiveFilterIterator;

class OriginalRecursiveFilterIteratorImpl extends \RecursiveFilterIterator
{
    public function accept()
    {
        return 0 < $this->current();
    }
}

<?php

namespace tomtomsen\Iterators\tests\RecursiveFilterIterator;

use tomtomsen\Iterators\RecursiveFilterIterator;

class RecursiveFilterIteratorImpl extends RecursiveFilterIterator
{
    public function accept()
    {
        return 0 < $this->current();
    }
}

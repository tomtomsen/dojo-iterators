<?php

namespace tomtomsen\Iterators\tests\RecursiveFilterIterator;

use tomtomsen\Iterators\tests\RecursiveFilterIterator\RecursiveFilterIteratorTestBase;

class RecursiveFilterIteratorTest extends RecursiveFilterIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new RecursiveFilterIteratorImpl(...$params);
    }
}

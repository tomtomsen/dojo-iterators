<?php

namespace tomtomsen\Iterators\tests\RecursiveFilterIterator;

use tomtomsen\Iterators\tests\RecursiveFilterIterator\RecursiveFilterIteratorTestBase;

class OriginalRecursiveFilterIteratorTest extends RecursiveFilterIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new OriginalRecursiveFilterIteratorImpl(...$params);
    }
}

<?php

namespace tomtomsen\Iterators\tests\RecursiveFilterIterator;

class OriginalRecursiveFilterIteratorTest extends RecursiveFilterIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new OriginalRecursiveFilterIteratorImpl(...$params);
    }
}

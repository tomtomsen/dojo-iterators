<?php

namespace tomtomsen\Iterators\tests\RecursiveFilterIterator;

class RecursiveFilerIteratorTest extends RecursiveFilterIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new RecursiveFilterIteratorImpl(...$params);
    }
}

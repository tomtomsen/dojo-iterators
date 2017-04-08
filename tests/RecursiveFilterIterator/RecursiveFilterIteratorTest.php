<?php

namespace tomtomsen\Iterators\tests\RecursiveFilterIterator;

class RecursiveFilterIteratorTest extends RecursiveFilterIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new RecursiveFilterIteratorImpl(...$params);
    }
}

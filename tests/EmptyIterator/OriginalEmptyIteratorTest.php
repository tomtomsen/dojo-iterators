<?php

namespace tomtomsen\Iterators\tests\EmptyIterator;

class OriginalEmptyIteratorTest extends EmptyIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new \EmptyIterator();
    }
}

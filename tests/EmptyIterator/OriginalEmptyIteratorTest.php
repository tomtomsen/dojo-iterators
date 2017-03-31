<?php

namespace tomtomsen\Iterators\tests\EmptyIterator;

class OriginalEmptyIteratorTest extends BasicEmptyIteratorTest
{
    protected function getIterator(...$params)
    {
        return new \EmptyIterator(...$params);
    }
}

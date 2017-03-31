<?php

namespace tomtomsen\Iterators\tests\NoRewindIterator;

class OriginalNoRewindIteratorTest extends BasicNoRewindIteratorTest
{
    protected function getIterator(...$params)
    {
        return new \NoRewindIterator(...$params);
    }
}

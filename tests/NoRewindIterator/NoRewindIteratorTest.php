<?php

namespace tomtomsen\Iterators\tests\NoRewindIterator;

use tomtomsen\Iterators\NoRewindIterator;

class NoRewindIteratorTest extends NoRewindIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new NoRewindIterator(...$params);
    }
}

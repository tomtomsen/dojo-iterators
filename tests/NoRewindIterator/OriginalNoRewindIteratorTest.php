<?php

namespace tomtomsen\Iterators\tests\NoRewindIterator;

class OriginalNoRewindIteratorTest extends NoRewindIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new \NoRewindIterator(...$params);
    }
}

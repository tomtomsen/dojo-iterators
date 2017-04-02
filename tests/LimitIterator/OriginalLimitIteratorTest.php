<?php

namespace tomtomsen\Iterators\tests\LimitIterator;

class OriginalLimitIteratorTest extends LimitIteratorTestBase
{
    public function getIterator(...$params)
    {
        return new \LimitIterator(...$params);
    }
}

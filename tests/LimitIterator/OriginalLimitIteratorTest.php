<?php

namespace tomtomsen\Iterators\tests\LimitIterator;

class OriginalLimitIteratorTest extends BaseLimitIteratorTest
{
    public function getIterator(...$params)
    {
        return new \LimitIterator(...$params);
    }
}

<?php

namespace tomtomsen\Iterators\tests\LimitIterator;

use tomtomsen\Iterators\LimitIterator;

class LimitIteratorTest extends LimitIteratorTestBase
{
    public function getIterator(...$params)
    {
        return new LimitIterator(...$params);
    }
}

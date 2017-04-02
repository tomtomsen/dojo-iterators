<?php

namespace tomtomsen\Iterators\tests\ArrayIterator;

class OriginalArrayIteratorTest extends ArrayIteratorTestBase
{
    public function getIterator(...$params)
    {
        return new \ArrayIterator(...$params);
    }
}

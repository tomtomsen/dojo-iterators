<?php

namespace tomtomsen\Iterators\tests\ArrayIterator;

class ArrayIteratorTest extends ArrayIteratorTestBase
{
    public function getIterator(...$params)
    {
        return new \tomtomsen\Iterators\ArrayIterator(...$params);
    }
}

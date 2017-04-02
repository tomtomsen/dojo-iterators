<?php

namespace tomtomsen\Iterators\tests\EmptyIterator;

use tomtomsen\Iterators\EmptyIterator;

class EmptyIteratorTest extends EmptyIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new EmptyIterator(...$params);
    }
}

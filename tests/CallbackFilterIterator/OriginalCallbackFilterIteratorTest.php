<?php

namespace tomtomsen\Iterators\tests\CallbackFilterIterator;

class OriginalCallbackFilterIteratorTest extends BasicCallbackFilterIteratorTest
{
    protected function getIterator(...$params)
    {
        return new \CallbackFilterIterator(...$params);
    }
}

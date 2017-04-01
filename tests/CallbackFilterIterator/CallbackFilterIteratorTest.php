<?php

namespace tomtomsen\Iterators\tests\CallbackFilterIterator;

use tomtomsen\Iterators\CallbackFilterIterator;

class CallbackFilterIteratorTest extends BasicCallbackFilterIteratorTest
{
    protected function getIterator(...$params)
    {
        return new CallbackFilterIterator(...$params);
    }
}

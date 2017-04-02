<?php

namespace tomtomsen\Iterators\tests\CallbackFilterIterator;

class OriginalCallbackFilterIteratorTest extends CallbackFilterIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new \CallbackFilterIterator(...$params);
    }
}

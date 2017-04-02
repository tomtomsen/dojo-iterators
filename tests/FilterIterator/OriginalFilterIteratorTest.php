<?php

namespace tomtomsen\Iterators\tests\FilterIterator;

/**
 * @group FilterIterator
 */
class OriginalFilterIteratorTest extends FilterIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new OriginalFilterIteratorImpl(...$params);
    }
}

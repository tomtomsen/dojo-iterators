<?php

namespace tomtomsen\Iterators\tests\FilterIterator;

/**
 * @group FilterIterator
 */
class FilterIteratorTest extends FilterIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new FilterIteratorImpl(...$params);
    }
}

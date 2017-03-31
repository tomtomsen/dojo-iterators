<?php

namespace tomtomsen\Iterators\tests\FilterIterator;

/**
 * @group FilterIterator
 */
class OriginalFilterIteratorTest extends BaseFilterIteratorTest
{
    protected function getIterator(...$params)
    {
        return new OriginalFilterIteratorImpl(...$params);
    }
}

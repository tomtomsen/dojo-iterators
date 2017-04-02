<?php

namespace tomtomsen\Iterators\tests\InfiniteIterator;

/**
 * Tests the SPL InfiniteIterator class
 *
 * @group InfiniteIterator
 * @group \tomtomsen\Iterators\InfiniteIterator
 */
class OriginalInfiniteIteratorTest // extends InfiniteIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new \InfiniteIterator(...$params);
    }
}

<?php

namespace tomtomsen\Iterators\tests\InfiniteIterator;

use tomtomsen\Iterators\InfiniteIterator;

/**
 * Tests our InfiniteIterator.
 *
 * @group InfiniteIterator
 * @group \tomtomsen\Iterators\InfiniteIterator
 */
class InfiniteIteratorTest extends InfiniteIteratorTestBase
{
    /**
     * {@inheritdoc}
     */
    protected function getIterator(...$params)
    {
        return new InfiniteIterator(...$params);
    }
}

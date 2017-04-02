<?php

namespace tomtomsen\Iterators\tests\IteratorIterator;

use tomtomsen\Iterators\IteratorIterator;

/**
 * @group IteratorIterator
 */
class IteratorIteratorTest extends IteratorIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new IteratorIterator(...$params);
    }
}

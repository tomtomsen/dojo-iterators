<?php

namespace tomtomsen\Iterators\tests\IteratorIterator;

/**
 * @group IteratorIterator
 */
class OriginalIteratorIteratorTest extends IteratorIteratorTestBase
{
    protected function getIterator(...$params)
    {
        return new \IteratorIterator(...$params);
    }
}

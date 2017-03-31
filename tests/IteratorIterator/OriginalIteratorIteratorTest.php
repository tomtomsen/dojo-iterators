<?php

namespace tomtomsen\Iterators\tests\IteratorIterator;

/**
 * @group IteratorIterator
 */
class OriginalIteratorIteratorTest extends BasicIteratorIteratorTest
{
	protected function getIterator(...$params) {
		return new \IteratorIterator(...$params);
	}
}

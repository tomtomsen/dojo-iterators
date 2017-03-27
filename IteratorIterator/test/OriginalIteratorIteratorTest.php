<?php

namespace tomtomsen\Iterators;

/**
 * @group IteratorIterator
 */
class OriginalIteratorIteratorTest extends BasicIteratorIteratorTest
{
	protected function getIterator(...$params) {
		return new \IteratorIterator(...$params);
	}
}

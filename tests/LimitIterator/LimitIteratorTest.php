<?php

namespace tomtomsen\Iterators\tests\LimitIterator;

use tomtomsen\Iterators\LimitIterator;

class LimitIteratorTest extends BaseLimitIteratorTest
{
	public function getIterator(...$params) {
		return new LimitIterator(...$params);
	}
}

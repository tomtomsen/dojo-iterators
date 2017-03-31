<?php

namespace tomtomsen\Iterators\tests\EmptyIterator;

use tomtomsen\Iterators\EmptyIterator;

class EmptyIteratorTest extends BasicEmptyIteratorTest
{
	protected function getIterator(...$params) {
		return new EmptyIterator(...$params);
	}
}

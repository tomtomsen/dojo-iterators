<?php

namespace tomtomsen\Iterators\tests\ArrayIterator;

class OriginalArrayIteratorTest extends BasicArrayIteratorTest
{
	public function getIteratorClass() {
		return '\ArrayIterator';
	}
}

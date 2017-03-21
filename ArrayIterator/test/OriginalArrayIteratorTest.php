<?php

namespace tomtomsen\Iterators;

require __DIR__ . '/../src/ArrayIterator.php';
require_once __DIR__ . '/BasicArrayIteratorTest.php';

class OriginalArrayIteratorTest extends BasicArrayIteratorTest
{
	public function getIteratorClass() {
		return '\ArrayIterator';
	}
}

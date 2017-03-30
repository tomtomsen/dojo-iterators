<?php

namespace tomtomsen\Iterators;

require __DIR__ . '/../src/LimitIterator.php';
require_once __DIR__ . '/BaseLimitIteratorTest.php';

class LimitIteratorTest extends BaseLimitIteratorTest
{
	public function getIterator(...$params) {
		return new LimitIterator(...$params);
	}
}

<?php

namespace tomtomsen\Iterators;

require_once __DIR__ . '/BaseLimitIteratorTest.php';

class OriginalLimitIteratorTest extends BaseLimitIteratorTest
{
	public function getIterator(...$params) {
		return new \LimitIterator(...$params);
	}
}

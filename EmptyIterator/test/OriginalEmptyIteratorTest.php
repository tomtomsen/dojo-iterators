<?php

namespace tomtomsen\Iterators;

require_once __DIR__ . '/BasicEmptyIteratorTest.php';

class OriginalEmptyIteratorTest extends BasicEmptyIteratorTest
{
	protected function getIterator(...$params) {
		return new \EmptyIterator(...$params);
	}
}

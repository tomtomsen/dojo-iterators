<?php

namespace tomtomsen\Iterators;

require __DIR__ . '/../src/EmptyIterator.php';
require_once __DIR__ . '/BasicEmptyIteratorTest.php';

class EmptyIteratorTest extends BasicEmptyIteratorTest
{
	protected function getIterator(...$params) {
		return new EmptyIterator(...$params);
	}
}

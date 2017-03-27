<?php

namespace tomtomsen\Iterators;

require __DIR__ . '/../src/IteratorIterator.php';
require_once __DIR__ . '/BasicIteratorIteratorTest.php';

/**
 * @group IteratorIterator
 */
class IteratorIteratorTest extends BasicIteratorIteratorTest
{
	protected function getIterator(...$params) {
		return new IteratorIterator(...$params);
	}
}
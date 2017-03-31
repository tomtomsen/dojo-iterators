<?php

namespace tomtomsen\Iterators\tests\FilterIterator;

/**
 * @group FilterIterator
 */
class FilterIteratorTest extends BaseFilterIteratorTest
{
	protected function getIterator(...$params) {
		return new FilterIteratorImpl(...$params);
	}
}

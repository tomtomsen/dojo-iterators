<?php

namespace tomtomsen\Iterators;

require __DIR__ . '/../src/FilterIterator.php';
require_once __DIR__ . '/BaseFilterIteratorTest.php';

/**
 * @group FilterIterator
 */
class FilterIteratorTest extends BaseFilterIteratorTest
{
	protected function getIterator(...$params) {
		return new FilterIteratorImpl(...$params);
	}
}

class FilterIteratorImpl extends FilterIterator {
	public function accept() {
		$value = $this->getInnerIterator()->current();

		return 0 < $value;
	}
}
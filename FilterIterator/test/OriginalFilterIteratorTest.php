<?php

namespace tomtomsen\Iterators;

require_once __DIR__ . '/BaseFilterIteratorTest.php';

/**
 * @group FilterIterator
 */
class OriginalFilterIteratorTest extends BaseFilterIteratorTest
{
	protected function getIterator(...$params) {
		return new OriginalFilterIteratorImpl(...$params);
	}
}

class OriginalFilterIteratorImpl extends \FilterIterator
{
	public function accept() {
		$value = $this->getInnerIterator()->current();

		return 0 < $value;
	}
}

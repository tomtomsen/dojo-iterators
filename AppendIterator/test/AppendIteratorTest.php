<?php

namespace tomtomsen\Iterators;

require __DIR__ . '/../src/AppendIterator.php';
require_once __DIR__ . '/BasicAppendIteratorTest.php';

class AppendIteratorTest extends BasicAppendIteratorTest
{
	public function getIteratorClass() {
		return '\tomtomsen\Iterators\AppendIterator';
	}
}

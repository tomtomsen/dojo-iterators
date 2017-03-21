<?php

namespace tomtomsen\Iterators;

require_once __DIR__ . '/BasicAppendIteratorTest.php';

class OriginalAppendIteratorTest extends BasicAppendIteratorTest
{
	public function getIteratorClass() {
		return '\AppendIterator';
	}
}

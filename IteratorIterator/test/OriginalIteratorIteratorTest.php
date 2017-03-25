<?php

namespace tomtomsen\Iterators;

class OriginalIteratorIteratorTest extends BasicIteratorIteratorTest
{
	protected function getIterator(...$params) {
		return new \IteratorIterator(...$params);
	}
}

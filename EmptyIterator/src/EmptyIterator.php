<?php

namespace tomtomsen\Iterators;

class EmptyIterator implements \Iterator
{
	public function current() /* mixed */ {
		throw new \BadMethodCallException('Accessing the value of an EmptyIterator');
	}

	public function key() /* scalar */ {
		throw new \BadMethodCallException('Accessing the key of an EmptyIterator');
	}

	public function next() /* void */ {
	}

	public function rewind() /* void */ {
	}

	public function valid() /* bool */ {
		return false;
	}
}

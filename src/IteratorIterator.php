<?php

namespace tomtomsen\Iterators;

class IteratorIterator implements \OuterIterator
{
	private $_iterator;

	public function __construct(\Traversable $iterator) {
		$this->_iterator = $iterator;
	}

	public function current() /* : mixed  */ {
		try {
			return $this->_iterator->current();
		} catch (\BadMethodCallException $ex) {
			return null;
		}
	}

	public function getInnerIterator() /* : Traversable  */ {
		return $this->_iterator;
	}

	public function key() /* : scalar  */ {
		return $this->_iterator->key();
	}

	public function next() /* : void  */ {
		$this->_iterator->next();
	}

	public function rewind() /* : void  */ {
		$this->_iterator->rewind();
	}

	public function valid() /* : bool  */ {
		return $this->_iterator->valid();
	}
}

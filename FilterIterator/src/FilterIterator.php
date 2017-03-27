<?php

namespace tomtomsen\Iterators;

require_once __DIR__ . '/../../IteratorIterator/src/IteratorIterator.php';

abstract class FilterIterator extends IteratorIterator implements \OuterIterator
{
	abstract public function accept() /* : bool */;

	public function __construct(\Iterator $iterator) {
		parent::__construct($iterator);
	}

	public function valid() {
		if (!$this->getInnerIterator()->valid()) {
			return false;
		}

		do {
			$this->getInnerIterator()->next();
		} while (!$this->accept() && $this->getInnerIterator()->valid());

		return $this->getInnerIterator()->valid();
	}
}

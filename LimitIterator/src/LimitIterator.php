<?php

namespace tomtomsen\Iterators;

require_once __DIR__ . '/../../IteratorIterator/src/IteratorIterator.php';

/**
 * @group \LimitIterator
 */
class LimitIterator extends IteratorIterator implements \OuterIterator
{
	private $_position;
	private $_offset;
	private $_count;

	public function __construct($iterator, $offset = 0, $count = -1) {
		if (!$iterator instanceOf \Iterator) {
			throw new \TypeError('Argument 1 passed to ' . __CLASS__ . '::__construct() must implement interface Iterator, ' . gettype($iterator) . ' given');
		}

		if (!is_int($offset)) {
			throw new \TypeError('' . __CLASS__ . '::__construct() expects parameter 2 to be integer, ' . gettype($offset) . ' given');
		} elseif (0 > $offset) {
			throw new \OutOfRangeException('Parameter offset must be >= 0');
		}

		if (!is_int($count)) {
			throw new \TypeError('' . __CLASS__ . '::__construct() expects parameter 3 to be integer, ' . gettype($count) . ' given');
		} elseif (-1 > $count) {
			throw new \OutOfRangeException('Parameter count must either be -1 or a value greater than or equal 0');
		}

		parent::__construct($iterator);

		$this->_offset = $offset;
		$this->_position = 0;
		$this->_count = $count;
	}

	public function getPosition() /* : int */ {
		return $this->_position;
	}

	public function seek($position) /* : int */ {
		if (!is_numeric($position)) {
			trigger_error('' . __CLASS__ . '::seek() expects parameter 1 to be integer, ' . gettype($position) . ' given', E_USER_WARNING);
		} else if ($position < 0) {
			throw new \OutOfBoundsException('Cannot seek to ' . $position . ' which is below the offset 0');
		}

		parent::rewind();
		$this->_position = 0;
		for ($i = $position; $i-- && parent::valid();) {
			parent::next();
			$this->_position++;
		}

		if (!parent::valid()) {
			throw new \OutOfBoundsException('Seek position ' . (string) $position . ' is out of range');
		}

		return $this->getPosition();
	}

	public function rewind() {
		parent::rewind();

		$this->seek($this->_offset);
	}

	public function next() {
		$this->_position++;
		parent::next();
	}

	public function valid() {
		if ($this->_count > -1 && $this->_offset + $this->_count <= $this->_position) {
			return false;
		}

		return parent::valid();
	}
}

<?php

namespace tomtomsen\Iterators;

class ArrayIterator implements \ArrayAccess, \SeekableIterator, \Countable, \Serializable
{
	private $_array;
	private $_flags;
	private $_beyondLastField;

	public function __construct($array = array(), $flags = 0) {
		if (!is_array($array) && !is_object($array)) {
			throw new \InvalidArgumentException('Passed variable is not an array or object, using empty array instead');
		}

		if (!is_numeric($flags)) {
			throw new \TypeError('ArrayIterator::__construct() expects parameter 2 to be integer, ' . gettype($flags) . ' given');
		}

		$this->_array = $array;
		$this->setFlags($flags);
		$this->rewind();
	}

	public function __get($offset) {
		if (($this->_flags & 2) == 2) {
			return $this->offsetGet($offset);
		}

		return $this->$offset;
	}

	public function __set($offset, $value) {
		if (($this->_flags & 2) == 2) {
			$this->offsetSet($offset, $value);
		} else {
			$this->$offset = $value;
		}

		return null;
	}

	/**
	 * ArrayAccess::offsetExists
	 */
	public function offsetExists($offset) {
		$this->validateOffset($offset);

		return (bool) array_key_exists($offset, $this->_array);
	}

	/**
	 * ArrayAccess::offsetGet
	 */
	public function offsetGet($offset) {
		$this->validateOffset($offset);

		return $this->_array[$offset];
	}

	/**
	 * ArrayAccess::offsetSet
	 */
	public function offsetSet($offset, $value) {
		$this->validateOffset($offset);

		$this->_array[$offset] = $value;
	}

	/**
	 * ArrayAccess::offsetUnset
	 */
	public function offsetUnset($offset) {
		$this->validateOffset($offset);

		unset($this->_array[$offset]);
	}

	protected function validateOffset($offset) {
		if (!is_string($offset) && !is_integer($offset)) {
			trigger_error('Illegal offset type', E_USER_WARNING);
		}
	}

	/**
	 * SeekableIterator::seek
	 */
	public function seek($position) {

		if (!is_numeric($position)) {
			trigger_error('ArrayIterator::seek() expects parameter 1 to be integer, ' . gettype($flags) . ' given', E_USER_WARNING);
		}

		$this->rewind();

		for($i = $position; $i--; ) {
			$this->next();

			if ($this->_beyondLastField) {
				throw new \OutOfBoundsException("Seek position $position is out of range");
			}
		}
	}

	/**
	 * SeekableIterator::current
	 */
	public function current() {
		return current($this->_array);
	}

	/**
	 * SeekableIterator::key
	 */
	public function key() {
		return key($this->_array);
	}

	/**
	 * SeekableIterator::next
	 */
	public function next() {
		$next = next($this->_array);
		$key = key($this->_array);

		if (!isset($key)) {
			$this->_beyondLastField = true;
		}

		return false;
	}

	/**
	 * SeekableIterator::rewind
	 */
	public function rewind() {
		$this->_beyondLastField = false;
		reset($this->_array);
	}

	/**
	 * SeekableIterator::valid
	 */
	public function valid() {
		return false !== current($this->_array);
	}

	/**
	 * Countable::count
	 */
	public function count() {
		return count($this->_array);
	}

	/**
	 * Serializable::serialize
	 */
	public function serialize() {
		return serialize($this->_array);
	}

	/**
	 * Serializable::unserialize
	 */
	public function unserialize($serialized) {
		return unserialize($serialized);
	}

	public function append($value) {
		array_push($this->_array, $value);
	}

	public function asort() {
		asort($this->_array);
	}

	public function getArrayCopy() {
		return $this->_array;
	}

	public function getFlags() {
		return $this->_flags;
	}

	public function ksort() {
		ksort($this->_array);
	}

	public function natcasesort() {
		natcasesort($this->_array);
	}

	public function natsort() {
		natsort($this->_array);
	}

	public function setFlags($flags) {
		$this->_flags  = $flags;
	}

	public function uasort($cmp_function) {
		uasort($this->_array, $cmp_function);
	}

	public function uksort($cmp_function) {
		uksort($this->_array, $cmp_function);
	}
}

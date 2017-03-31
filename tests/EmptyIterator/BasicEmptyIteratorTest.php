<?php

namespace tomtomsen\Iterators\tests\EmptyIterator;

abstract class BasicEmptyIteratorTest extends \PHPUnit\Framework\TestCase
{
	abstract protected function getIterator(...$params);

	public function testValid() {
		$iterator = $this->getIterator();

		$this->assertFalse($iterator->valid());
	}

	/**
	 * @test
	 * @expectedException \BadMethodCallException
	 * @expectedExceptionMessageRegExp /^Accessing the value of an EmptyIterator$/
	 */
	public function testCurrentThrowsException() {
		$iterator = $this->getIterator();

		$iterator->rewind();
		$iterator->current();
	}

	/**
	 * @test
	 * @expectedException \BadMethodCallException
	 * @expectedExceptionMessageRegExp /^Accessing the key of an EmptyIterator$/
	 */
	public function testKey() {
		$iterator = $this->getIterator();

		$iterator->key();
	}
}

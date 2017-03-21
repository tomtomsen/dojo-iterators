<?php

namespace tomtomsen\Iterators;

abstract class BasicAppendIteratorTest extends \PHPUnit\Framework\TestCase
{
	abstract public function getIteratorClass();

	public function createAppendIterator(...$params) {
		$className = $this->getIteratorClass();
		return new $className(...$params);
	}

	/**
	 * @test
	 * @expectedException \Error
	 * @expectedExceptionMessageRegExp /Argument 1 passed to \w+::append\(\) must implement interface Iterator, \w+ given/
	 */
	public function testAppendWithIntegerArgument() {
		$iterator = $this->createAppendIterator();
		$iterator->append(2);
	}

	/**
	 * @test
	 * @expectedException \Error
	 * @expectedExceptionMessageRegExp /Argument 1 passed to \w+::append\(\) must implement interface Iterator, \w+ given/
	 */
	public function testAppendWithNullArgument() {
		$iterator = $this->createAppendIterator();
		$iterator->append(null);
	}

	/**
	 * @test
	 */
	public function testAppend() {
		$innerIterator = new \ArrayIterator(['a', 'b']);

		$iterator = $this->createAppendIterator();
		$iterator->append($innerIterator);
		$iterator->append($innerIterator);

		$this->assertEquals($innerIterator, $iterator->getInnerIterator());
	}

	public function testGetIteratorIndex() {
		$appendIterator = $this->createAppendIterator();
		$appendIterator->append(new \ArrayIterator(['a']));
		$appendIterator->append(new \ArrayIterator(['a']));

		$this->assertEquals(0, $appendIterator->getIteratorIndex());
	}

	public function testCurrent() {
		$data = ['a', 'b', 'c'];

		$appendIterator = $this->createAppendIterator();
		$appendIterator->append(new \ArrayIterator(['a']));
		$appendIterator->append(new \ArrayIterator(['b']));
		$appendIterator->append(new \ArrayIterator(['c']));

		$appendIterator->rewind();
		$appendIterator->next();

		$this->assertEquals('b', $appendIterator->current());
	}

	public function getCurrentWithEmptyIterator() {
		$appendIterator = $this->createAppendIterator();
		$appendIterator->append(new \EmptyIterator());
		$appendIterator->append(new \EmptyIterator());
		$appendIterator->append(new \EmptyIterator());

		$appendIterator->rewind();

		$this->assertNull($appendIterator->current());
	}

	public function testGetInnerIterator() {
		$expectedIterator = new \ArrayIterator(['b']);

		$appendIterator = $this->createAppendIterator();
		$appendIterator->append(new \ArrayIterator(['a']));
		$appendIterator->append($expectedIterator);
		$appendIterator->append(new \ArrayIterator(['c']));

		$appendIterator->rewind();
		$appendIterator->next();

		$this->assertEquals($expectedIterator, $appendIterator->getInnerIterator());
	}

	public function testGetArrayIterator() {
		$iterators = [
			new \ArrayIterator(['a', 'b']),
			new \EmptyIterator(),
		];

		$appendIterator = $this->createAppendIterator();
		$appendIterator->append($iterators[0]);
		$appendIterator->append($iterators[1]);

		$arrayIterator = $appendIterator->getArrayIterator();
		$this->assertNotEmpty($arrayIterator);

		$array = $arrayIterator->getArrayCopy();
		$this->assertEquals($array[0], $iterators[0]);
		$this->assertEquals($array[1], $iterators[1]);
	}

	public function testGetArrayIteratorWithEmptyAppendIterator() {
		$appendIterator = $this->createAppendIterator();
		$arrayIterator = $appendIterator->getArrayIterator();

		$this->assertEmpty($arrayIterator);
	}

	public function testGetArrayIteratorUsingEmptyIterator() {
		$appendIterator = $this->createAppendIterator();
		$appendIterator->append(new \EmptyIterator());

		$arrayIterator = $appendIterator->getArrayIterator();

		$this->assertNotEmpty($arrayIterator);
	}
}

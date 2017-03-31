<?php

namespace tomtomsen\Iterators\tests\ArrayIterator;

abstract class BasicArrayIteratorTest extends \PHPUnit\Framework\TestCase
{
	abstract public function getIteratorClass();

	public function createArrayIterator(...$params) {
		$className = $this->getIteratorClass();
		return new $className(...$params);
	}

	/**
	 * @test
	 * @dataProvider getInvalidConstructorArrayParam
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage Passed variable is not an array or object
	 */
	public function testConstructorWithInvalidArrayThrowsInvalidArgumentException($invalidArrayParam) {
		$this->createArrayIterator($invalidArrayParam);
	}

	/**
	 * Invalid Array Argument
	 *
	 * @return array[] List of parameters
	 */
	public function getInvalidConstructorArrayParam() {
		return [
			[true],
			[27],
			[null],
			["some string"],
		];
	}

	/**
	 * @test
	 * @dataProvider getInvalidConstructorFlagParam
	 * @expectedException \TypeError
	 * @expectedExceptionMessageRegExp /expects parameter 2 to be integer/
	 */
	public function testConstructorWithInvalidFlagArgument($invalidFlagParam) {
		$this->createArrayIterator([], $invalidFlagParam);
	}

	/**
	 * Invalid Flag Argument
	 *
	 * @return array[] List of parameters
	 */
	public function getInvalidConstructorFlagParam() {
		return [
			['test'],
			[[]],
			[new \stdClass()],
		];
	}

	/**
	 * @test
	 * @expectedException PHPUnit\Framework\Error\Warning
	 * @expectedExceptionMessage Illegal offset type
	 */
	public function testOffsetExistsWithInvalidOffset() {
		$iterator = $this->createArrayIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
		$iterator->offsetExists([]);
	}

	/**
	 * @test
	 */
	public function testOffsetExistsWithExistingOffset() {
		$iterator = $this->createArrayIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
		$offsetExists = $iterator->offsetExists('2');

		$this->assertTrue($offsetExists);
	}

	/**
	 * @test
	 */
	public function testOffsetExistsWithNotExistingOffset() {
		$iterator = $this->createArrayIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
		$offsetExists = $iterator->offsetExists('4');

		$this->assertFalse($offsetExists);
	}

	/**
	 * @test
	 * @expectedException PHPUnit\Framework\Error\Warning
	 * @expectedExceptionMessage Illegal offset type
	 */
	public function testOffsetGetWithInvalidOffset() {
		$iterator = $this->createArrayIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
		$iterator->offsetGet([]);
	}

	/**
	 * @test
	 */
	public function testOffsetGetWithExistingOffset() {
		$iterator = $this->createArrayIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
		$value = $iterator->offsetGet('2');

		$this->assertEquals('second', $value);
	}

	/**
	 * @test
	 */
	public function testOffsetGetWithNotExistingOffset() {
		$iterator = $this->createArrayIterator(['1' => 'first', '2' => 'second', '3' => 'third']);

		$reportLevel = error_reporting(E_ALL ^  E_NOTICE);
		$value = $iterator->offsetGet(4);
		error_reporting($reportLevel);

		$this->assertNull($value);
	}

	/**
	 * @test
	 * @expectedException PHPUnit\Framework\Error\Warning
	 * @expectedExceptionMessage Illegal offset type
	 */
	public function testOffsetSetWithInvalidOffset() {
		$iterator = $this->createArrayIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
		$iterator->offsetSet([], 'test');
	}

	/**
	 * @test
	 */
	public function testOffsetSetWithExistingOffset() {
		$iterator = $this->createArrayIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
		$iterator->offsetSet('2', 'zwei');

		$value = $iterator->offsetGet('2');
		$this->assertEquals('zwei', $value);
	}

	/**
	 * @test
	 */
	public function testOffsetSetWithNotExistingOffset() {
		$iterator = $this->createArrayIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
		$iterator->offsetSet('4', 'forth');

		$value = $iterator->offsetGet('4');
		$this->assertEquals('forth', $value);
	}

	/**
	 * @test
	 */
	public function testIterate() {
		$arr = ['1' => 'first', '2' => 'second', '3' => 'third'];

		$iterator = $this->createArrayIterator($arr);
		foreach ($iterator as $key => $value) {
			$this->assertEquals($arr[$key], $value);
		}
	}

	/**
	 * @test
	 */
	public function testFlags() {
		$iterator = $this->createArrayIterator([], 0);
		$iterator->p = 'p';
		$iterator['a'] = 'a';
		$this->assertEquals(['a' => 'a'], $iterator->getArrayCopy());

		$iterator = $this->createArrayIterator([], 1);
		$iterator->p = 'p';
		$iterator['a'] = 'a';
		$this->assertEquals(['a' => 'a'], $iterator->getArrayCopy());

		$iterator = $this->createArrayIterator([], 2);
		$iterator->p = 'p';
		$iterator['a'] = 'a';
		$this->assertEquals(['p' => 'p', 'a' => 'a'], $iterator->getArrayCopy());
	}

	/**
	 * @test
	 */
	public function testSetFlags() {

		$iterator = $this->createArrayIterator([]);
		$iterator['a'] = 'a';
		$iterator->setFlags(3);
		$iterator->p = 'p';

		$this->assertEquals('p', $iterator->p);
		$this->assertEquals(['p' => 'p', 'a' => 'a'], $iterator->getArrayCopy());
	}

	/**
	 * @test
	 */
	public function testGetFlagsSetByConstructor() {
		$expectedFlags = 2;

		$iterator = $this->createArrayIterator([], $expectedFlags);

		$actualFlags = $iterator->getFlags();

		$this->assertEquals($expectedFlags, $actualFlags);
	}

	/**
	 * @test
	 */
	public function testGetFlagsReturnsValueSetBySetFlags() {
		$expectedFlags = 2;

		$iterator = $this->createArrayIterator([], 0);
		$iterator->setFlags($expectedFlags);

		$actualFlags = $iterator->getFlags();

		$this->assertEquals($expectedFlags, $actualFlags);
	}

	/**
	 * @test
	 * @expectedException PHPUnit\Framework\Error\Warning
	 * @expectedExceptionMessageRegExp /expects parameter 1 to be integer/
	 */
	public function testSeekWithInvalidArgument() {
		$iterator = $this->createArrayIterator([]);
		$iterator->seek('string');
	}

	/**
	 * @test
	 */
	public function testSeekToValidPosition() {
		$arr = ['1' => 'first', '2' => 'second', '3' => 'third'];

		$iterator = $this->createArrayIterator($arr);
		$iterator->seek(2);
		$this->assertEquals('third', $iterator->current());
	}

	/**
	 * @test
	 * @expectedException \OutOfBoundsException
	 * @expectedExceptionMessage Seek position 4 is out of range
	 */
	public function testSeekOutOfBounds() {
		$arr = ['1' => 'first', '2' => 'second', '3' => 'third'];

		$iterator = $this->createArrayIterator($arr);
		$iterator->seek(4);
	}

	/**
	 * @test
	 */
	public function testAssociativeKey() {
		$arr = ['first' => 'first element'];

		$iterator = $this->createArrayIterator($arr);
		$key = $iterator->key();

		$this->assertEquals('first', $key);
	}

	/**
	 * @test
	 */
	public function testNumericalKey() {
		$arr = ['first element'];

		$iterator = $this->createArrayIterator($arr);
		$key = $iterator->key();

		$this->assertEquals(0, $key);
	}

	/**
	 * @test
	 * @expectedException PHPUnit\Framework\Error\Warning
	 * @expectedExceptionMessage unserialize() expects parameter 1 to be string, object given
	 */
	public function testUnserializeWithInvalidArgument() {
		$iterator = $this->createArrayIterator([], 0);
		$iterator = $iterator->unserialize(new \stdClass());
	}

	/**
	 * @test
	 */
	public function testUnserializeFromSerialize() {
		$iterator = $this->createArrayIterator(['a', 'b'], 2);
		$iterator->seek(1);

		$newIterator = unserialize(serialize($iterator));

		$this->assertInstanceOf(get_class($iterator), $newIterator);
		$this->assertEquals(2, $newIterator->getFlags());
		$this->assertEquals(['a', 'b'], $newIterator->getArrayCopy());
		$this->assertEquals('a', $newIterator->current());
	}

	/**
	 * @test
	 */
	public function testArrayCopy() {
		$iterator = $this->createArrayIterator(['a', 'b', 'c']);

		$original = $iterator->getArrayCopy();

		$iterator->append('x');
		$extended = $iterator->getArrayCopy();

		$this->assertNotEquals($original, $extended);
	}
}

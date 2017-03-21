<?php

namespace tomtomsen\Iterators;

require __DIR__ . '/../src/ArrayIterator.php';

class ArrayIteratorTest extends \PHPUnit\Framework\TestCase
{

	/**
	 * @test
	 * @dataProvider getInvalidConstructorArrayParam
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage Passed variable is not an array or object, using empty array instead
	 */
	public function testCallingConstructorWithInvalidArrayThrowsInvalidArgumentException($invalidArrayParam) {
		foreach ($this->getIterators() as $iteratorClass) {
			new $iteratorClass($invalidArrayParam);
		}
	}

	/**
	 * @test
	 * @dataProvider getInvalidConstructorFlagParam
	 * @expectedException \TypeError
	 * @expectedExceptionMessageRegExp /expects parameter 2 to be integer/
	 */
	public function testCallingConstructorWithInvalidFlagArgument($invalidFlagParam) {
		foreach ($this->getIterators() as $iteratorClass) {
			new $iteratorClass(array(), $invalidFlagParam);
		}
	}

	/**
	 * @test
	 * @expectedException PHPUnit\Framework\Error\Warning
	 * @expectedExceptionMessage Illegal offset type
	 */
	public function testOffsetExistsWithInvalidOffset() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('1' => 'first', '2' => 'second', '3' => 'third'));
			$iterator->offsetExists(array());
		}
	}

	/**
	 * @test
	 */
	public function testOffsetExistsWithExistingOffset() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('1' => 'first', '2' => 'second', '3' => 'third'));
			$offsetExists = $iterator->offsetExists('2');

			$this->assertTrue($offsetExists);
		}
	}

	/**
	 * @test
	 */
	public function testOffsetExistsWithNotExistingOffset() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('1' => 'first', '2' => 'second', '3' => 'third'));
			$offsetExists = $iterator->offsetExists('4');

			$this->assertFalse($offsetExists);
		}
	}

	/**
	 * @test
	 * @expectedException PHPUnit\Framework\Error\Warning
	 * @expectedExceptionMessage Illegal offset type
	 */
	public function testOffsetGetWithInvalidOffset() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('1' => 'first', '2' => 'second', '3' => 'third'));
			$iterator->offsetGet(array());
		}
	}

	/**
	 * @test
	 */
	public function testOffsetGetWithExistingOffset() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('1' => 'first', '2' => 'second', '3' => 'third'));
			$value = $iterator->offsetGet('2');

			$this->assertEquals('second', $value);
		}
	}

	/**
	 * @test
	 */
	public function testOffsetGetWithNotExistingOffset() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('1' => 'first', '2' => 'second', '3' => 'third'));

			$reportLevel = error_reporting(E_ALL ^  E_NOTICE);
			$value = $iterator->offsetGet(4);
			error_reporting($reportLevel);

			$this->assertNull($value);
		}
	}

	/**
	 * @test
	 * @expectedException PHPUnit\Framework\Error\Warning
	 * @expectedExceptionMessage Illegal offset type
	 */
	public function testOffsetSetWithInvalidOffset() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('1' => 'first', '2' => 'second', '3' => 'third'));
			$iterator->offsetSet(array(), 'test');
		}
	}

	/**
	 * @test
	 */
	public function testOffsetSetWithExistingOffset() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('1' => 'first', '2' => 'second', '3' => 'third'));
			$iterator->offsetSet('2', 'zwei');

			$value = $iterator->offsetGet('2');
			$this->assertEquals('zwei', $value);
		}
	}

	/**
	 * @test
	 */
	public function testOffsetSetWithNotExistingOffset() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('1' => 'first', '2' => 'second', '3' => 'third'));
			$iterator->offsetSet('4', 'forth');

			$value = $iterator->offsetGet('4');
			$this->assertEquals('forth', $value);
		}
	}

	public function testIterate() {
		$arr = array('1' => 'first', '2' => 'second', '3' => 'third');

		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass($arr);
			foreach ($iterator as $key => $value) {
				$this->assertEquals($arr[$key], $value);
			}
		}
	}

	public function testFlags() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array(), 0);
			$iterator->p = 'p';
			$iterator['a'] = 'a';
			$this->assertEquals(array('a' => 'a'), $iterator->getArrayCopy());

			$iterator = new $iteratorClass(array(), 1);
			$iterator->p = 'p';
			$iterator['a'] = 'a';
			$this->assertEquals(array('a' => 'a'), $iterator->getArrayCopy());

			$iterator = new $iteratorClass(array(), 2);
			$iterator->p = 'p';
			$iterator['a'] = 'a';
			$this->assertEquals(array('p' => 'p', 'a' => 'a'), $iterator->getArrayCopy());
		}
	}

	public function testSetFlags() {

		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array());
			$iterator['a'] = 'a';
			$iterator->setFlags(3);
			$iterator->p = 'p';

			$this->assertEquals('p', $iterator->p);
			$this->assertEquals(array('p' => 'p', 'a' => 'a'), $iterator->getArrayCopy());
		}
	}

	/**
	 * @test
	 * @expectedException PHPUnit\Framework\Error\Warning
	 * @expectedExceptionMessageRegExp /expects parameter 1 to be integer/
	 */
	public function testSeekWithInvalidArgument() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array());
			$iterator->seek('string');
		}
	}

	public function testSeek() {
		$arr = array('1' => 'first', '2' => 'second', '3' => 'third');

		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass($arr);
			$iterator->seek(2);
			$this->assertEquals('third', $iterator->current());
		}
	}

	public function testSeekOutOfBounds() {
		$arr = array('1' => 'first', '2' => 'second', '3' => 'third');

		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass($arr);
			try {
				$iterator->seek(4);
				$this->fail('xxx');
			} catch (\OutOfBoundsException $ex) {
				$this->assertEquals('Seek position 4 is out of range', $ex->getMessage());
			}
		}
	}

	public function testArrayCopy() {
		foreach ($this->getIterators() as $iteratorClass) {
			$iterator = new $iteratorClass(array('a', 'b', 'c'));

			$a = $iterator->getArrayCopy();
			$iterator->append('x');
			$b = $iterator->getArrayCopy();

			$this->assertNotEquals($a, $b);
		}
	}

	public function getInvalidConstructorFlagParam() {
		return [
			['test'],
			[array()],
			[new \stdClass()],
		];
	}

	public function getInvalidConstructorArrayParam() {
		return [
			[true],
			[27],
			[null],
			["some string"],
		];
	}

	public function getIteratorProvider() {
		return array_map(function($item) { return [$item]; }, $this->getIterators());
	}

	public function getIterators() {
		return [
			'\ArrayIterator',
			'\tomtomsen\Iterators\ArrayIterator',
		];
	}
}

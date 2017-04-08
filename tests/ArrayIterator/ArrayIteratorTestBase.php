<?php

namespace tomtomsen\Iterators\tests\ArrayIterator;

use tomtomsen\Iterators\tests\IteratorTestBase;

/**
 * @group ArrayIterator
 */
abstract class ArrayIteratorTestBase extends IteratorTestBase
{
    /**
     * @test
     * @group ArrayIterator::__construct
     * @group ArrayIterator::__construct::$array
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Passed variable is not an array or object
     */
    public function testConstructorWithInvalidArrayThrowsInvalidArgumentException()
    {
        $this->getIterator(27);
    }

    /**
     * @test
     * @group ArrayIterator::__construct
     * @group ArrayIterator::__construct::$flags
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /expects parameter 2 to be integer/
     */
    public function testConstructorWithInvalidFlagArgument()
    {
        $this->getIterator([], 'string');
    }

    /**
     * @test
     * @group ArrayIterator::offsetExists
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage Illegal offset type
     */
    public function testOffsetExistsWithInvalidOffset()
    {
        $iterator = $this->getIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
        $iterator->offsetExists([]);
    }

    /**
     * @test
     * @group ArrayIterator::offsetExists
     */
    public function testOffsetExistsWithExistingOffset()
    {
        $iterator = $this->getIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
        $offsetExists = $iterator->offsetExists('2');

        $this->assertTrue($offsetExists);
    }

    /**
     * @test
     * @group ArrayIterator::offsetExists
     */
    public function testOffsetExistsWithNotExistingOffset()
    {
        $iterator = $this->getIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
        $offsetExists = $iterator->offsetExists('4');

        $this->assertFalse($offsetExists);
    }

    /**
     * @test
     * @group ArrayIterator::offsetGet
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage Illegal offset type
     */
    public function testOffsetGetWithInvalidOffset()
    {
        $iterator = $this->getIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
        $iterator->offsetGet([]);
    }

    /**
     * @test
     * @group ArrayIterator::offsetGet
     */
    public function testOffsetGetWithExistingOffset()
    {
        $iterator = $this->getIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
        $value = $iterator->offsetGet('2');

        $this->assertEquals('second', $value);
    }

    /**
     * @test
     * @group ArrayIterator::offsetGet
     */
    public function testOffsetGetWithNotExistingOffset()
    {
        $iterator = $this->getIterator(['1' => 'first', '2' => 'second', '3' => 'third']);

        $reportLevel = error_reporting(E_ALL ^ E_NOTICE);
        $value = $iterator->offsetGet(4);
        error_reporting($reportLevel);

        $this->assertNull($value);
    }

    /**
     * @test
     * @group ArrayIterator::offsetSet
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage Illegal offset type
     */
    public function testOffsetSetWithInvalidOffset()
    {
        $iterator = $this->getIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
        $iterator->offsetSet([], 'test');
    }

    /**
     * @test
     * @group ArrayIterator::offsetSet
     * @group ArrayIterator::offsetGet
     */
    public function testOffsetSetWithExistingOffset()
    {
        $iterator = $this->getIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
        $iterator->offsetSet('2', 'zwei');

        $value = $iterator->offsetGet('2');
        $this->assertEquals('zwei', $value);
    }

    /**
     * @test
     * @group ArrayIterator::offsetSet
     * @group ArrayIterator::offsetGet
     */
    public function testOffsetSetWithNotExistingOffset()
    {
        $iterator = $this->getIterator(['1' => 'first', '2' => 'second', '3' => 'third']);
        $iterator->offsetSet('4', 'forth');

        $value = $iterator->offsetGet('4');
        $this->assertEquals('forth', $value);
    }

    /**
     * @test
     */
    public function testIterate()
    {
        $arr = ['1' => 'first', '2' => 'second', '3' => 'third'];

        $iterator = $this->getIterator($arr);
        $this->assertEquals(3, count($iterator));
        foreach ($iterator as $key => $value) {
            $this->assertEquals($arr[$key], $value);
        }
    }

    /**
     * @test
     * @group ArrayIterator::setFlags
     */
    public function testFlags()
    {
        $iterator = $this->getIterator([], 0);
        $iterator->p = 'p';
        $iterator['a'] = 'a';
        $this->assertEquals(['a' => 'a'], $iterator->getArrayCopy());

        $iterator = $this->getIterator([], 1);
        $iterator->p = 'p';
        $iterator['a'] = 'a';
        $this->assertEquals(['a' => 'a'], $iterator->getArrayCopy());

        $iterator = $this->getIterator([], 2);
        $iterator->p = 'p';
        $iterator['a'] = 'a';
        $this->assertEquals(['p' => 'p', 'a' => 'a'], $iterator->getArrayCopy());
    }

    /**
     * @test
     * @group ArrayIterator::setFlags
     */
    public function testSetFlags()
    {
        $iterator = $this->getIterator([]);
        $iterator['a'] = 'a';
        $iterator->setFlags(3);
        $iterator->p = 'p';

        $this->assertEquals('p', $iterator->p);
        $this->assertEquals(['p' => 'p', 'a' => 'a'], $iterator->getArrayCopy());
    }

    /**
     * @test
     * @group ArrayIterator::getFlags
     */
    public function testGetFlagsSetByConstructor()
    {
        $expectedFlags = 2;

        $iterator = $this->getIterator([], $expectedFlags);

        $actualFlags = $iterator->getFlags();

        $this->assertEquals($expectedFlags, $actualFlags);
    }

    /**
     * @test
     * @group ArrayIterator::getFlags
     */
    public function testGetFlagsReturnsValueSetBySetFlags()
    {
        $expectedFlags = 2;

        $iterator = $this->getIterator([], 0);
        $iterator->setFlags($expectedFlags);

        $actualFlags = $iterator->getFlags();

        $this->assertEquals($expectedFlags, $actualFlags);
    }

    /**
     * @test
     * @group ArrayIterator::seek
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessageRegExp /expects parameter 1 to be integer/
     */
    public function testSeekWithInvalidArgument()
    {
        $iterator = $this->getIterator([]);
        $iterator->seek('string');
    }

    /**
     * @test
     * @group ArrayIterator::seek
     */
    public function testSeekToValidPosition()
    {
        $arr = ['1' => 'first', '2' => 'second', '3' => 'third'];

        $iterator = $this->getIterator($arr);
        $iterator->seek(2);
        $this->assertEquals('third', $iterator->current());
    }

    /**
     * @test
     * @group ArrayIterator::seek
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Seek position 4 is out of range
     */
    public function testSeekOutOfBounds()
    {
        $arr = ['1' => 'first', '2' => 'second', '3' => 'third'];

        $iterator = $this->getIterator($arr);
        $iterator->seek(4);
    }

    /**
     * @test
     * @group ArrayIterator::key
     */
    public function testAssociativeKey()
    {
        $arr = ['first' => 'first element'];

        $iterator = $this->getIterator($arr);
        $key = $iterator->key();

        $this->assertEquals('first', $key);
    }

    /**
     * @test
     * @group ArrayIterator::key
     */
    public function testNumericalKey()
    {
        $arr = ['first element'];

        $iterator = $this->getIterator($arr);
        $key = $iterator->key();

        $this->assertEquals(0, $key);
    }

    /**
     * @test
     * @group ArrayIterator::unserialize
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessage unserialize() expects parameter 1 to be string, object given
     */
    public function testUnserializeWithInvalidArgument()
    {
        $iterator = $this->getIterator([], 0);
        $iterator = $iterator->unserialize(new \stdClass());
    }

    /**
     * @test
     * @group ArrayIterator::unserialize
     */
    public function testUnserializeFromSerialize()
    {
        $iterator = $this->getIterator(['a', 'b'], 2);
        $iterator->seek(1);

        $newIterator = unserialize(serialize($iterator));

        $this->assertInstanceOf(get_class($iterator), $newIterator);
        $this->assertEquals(2, $newIterator->getFlags());
        $this->assertEquals(['a', 'b'], $newIterator->getArrayCopy());
        $this->assertEquals('a', $newIterator->current());
    }

    /**
     * @test
     * @group ArrayIterator::getArrayCopy
     */
    public function testArrayCopy()
    {
        $iterator = $this->getIterator(['a', 'b', 'c']);

        $original = $iterator->getArrayCopy();

        $iterator->append('x');
        $extended = $iterator->getArrayCopy();

        $this->assertNotEquals($original, $extended);
    }
}

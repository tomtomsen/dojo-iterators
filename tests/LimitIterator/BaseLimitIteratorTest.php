<?php

namespace tomtomsen\Iterators\tests\LimitIterator;

abstract class BaseLimitIteratorTest extends \PHPUnit_Framework_TestCase
{
    abstract protected function getIterator(...$params);

    /**
     * @test
     * @group \LimitIterator::__construct::iterator
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^Argument 1 passed to [\\\w]+::__construct\(\) must implement interface Iterator, integer given/
     */
    public function testConstructorInvalidItartorArgument()
    {
        $this->getIterator(7);
    }

    /**
     * @test
     * @group \LimitIterator::__construct::offset
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^[\\\w]+::__construct\(\) expects parameter 2 to be integer, array given/
     */
    public function testConstructorInvalidOffsetArgument()
    {
        $empty = new \EmptyIterator();
        $this->getIterator($empty, array());
    }

    /**
     * @test
     * @group \LimitIterator::__construct::offset
     * @expectedException \OutOfRangeException
     * @expectedExceptionMessage Parameter offset must be >= 0
     */
    public function testConstructorNegativeOffsetArgument()
    {
        $empty = new \EmptyIterator();
        $this->getIterator($empty, -2);
    }

    /**
     * @test
     * @group \LimitIterator::__construct::count
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^[\\\w]+::__construct\(\) expects parameter 3 to be integer, array given/
     */
    public function testConstructorInvalidCountArgument()
    {
        $array = new \ArrayIterator(['a', 'b', 'c']);
        $this->getIterator($array, 0, array());
    }

    /**
     * @test
     * @group \LimitIterator::__construct::count
     * @expectedException \OutOfRangeException
     * @expectedExceptionMessage Parameter count must either be -1 or a value greater than or equal 0
     */
    public function testConstructorNegativeCountArgument()
    {
        $array = new \ArrayIterator(['a', 'b', 'c']);
        $this->getIterator($array, 0, -99);
    }

    /**
     * @test
     * @group \LimitIterator::__construct::offset
     */
    public function testConstructorOffsetArgument()
    {
        $array = new \ArrayIterator(['a', 'b', 'c']);
        $iterator = $this->getIterator($array, 1);

        $iterator->rewind();
        $iterator->valid();
        $this->assertEquals('b', $iterator->current());
    }

    /**
     * @test
     * @group \LimitIterator::__construct::count
     */
    public function testConstructorCountArgument()
    {
        $array = new \ArrayIterator(['a', 'b', 'c', 'd']);
        $iterator = $this->getIterator($array, 1, 2);

        $iterator->rewind();
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertFalse($iterator->valid());
    }

    /**
     * @test
     * @group \LimitIterator::getPosition
     */
    public function testGetPosition()
    {
        $array = new \ArrayIterator(['a', 'b', 'c']);
        $iterator = $this->getIterator($array, 1);

        $position = 1;
        foreach ($iterator as $element) {
            $this->assertEquals($position++, $iterator->getPosition());
        }
    }

    /**
     * @test
     * @group \LimitIterator::getPosition
     */
    public function testGetPositionInitialization()
    {
        $fruits = new \ArrayIterator([
            'apple',
            'banana',
            'cherry',
            'damson',
            'elderberry',
        ]);

        $iterator = $this->getIterator($fruits, 2);

        $this->assertEquals(0, $iterator->getPosition());
    }

    /**
     * @test
     * @group \LimitIterator::getPosition
     */
    public function testGetPositionOutOfBounds()
    {
        $empty = new \EmptyIterator();

        $iterator = $this->getIterator($empty, 2);
        $iterator->next();

        $this->assertEquals(1, $iterator->getPosition());
    }

    /**
     * @test
     * @group \LimitIterator::getPosition
     */
    public function testRewindResetsPosition()
    {
        $array = new \ArrayIterator(['a', 'b', 'c']);
        $iterator = $this->getIterator($array, 1);

        $this->assertEquals(0, $iterator->getPosition());
        $iterator->rewind();
        $this->assertEquals(1, $iterator->getPosition());
    }

    /**
     * @test
     * @group \LimitIterator::seek
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Seek position 9 is out of range
     */
    public function testSeekOutOfBounds()
    {
        $empty = new \ArrayIterator(['a', 'b', 'c']);

        $iterator = $this->getIterator($empty);
        $position = $iterator->seek(9);
    }

    /**
     * @test
     * @group \LimitIterator::seek
     */
    public function testSeekToValidPosition()
    {
        $array = new \ArrayIterator(['a', 'b', 'c']);

        $iterator = $this->getIterator($array);
        $position = $iterator->seek(2);

        $this->assertEquals(2, $position);
        $this->assertEquals('c', $iterator->current());
    }

    /**
     * @test
     * @group \LimitIterator::seek
     * @expectedException PHPUnit_Framework_Error_Warning
     * @expectedExceptionMessageRegExp /^[\w\\]+::seek\(\) expects parameter 1 to be integer, array given/
     */
    public function testSeekWithInvalidArgument()
    {
        $array = new \ArrayIterator(['a', 'b', 'c']);
        $iterator = $this->getIterator($array);

        $iterator->seek(array());
    }

    /**
     * @test
     * @group \LimitIterator::seek
     * @expectedException \OutOfBoundsException
     * @expectedExceptionMessage Cannot seek to -2 which is below the offset 0
     */
    public function testSeekWithNegativeNumber()
    {
        $array = new \ArrayIterator(['a', 'b', 'c']);
        $iterator = $this->getIterator($array);

        $iterator->seek(-2);
    }
}

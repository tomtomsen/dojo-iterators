<?php

namespace tomtomsen\Iterators\tests\InfiniteIterator;

/**
 * Basic InifiteIterator test class
 */
abstract class BasicInfiniteIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Returns an instance of the InfiniteIterator class
     * @return mixed an InfiniteIterator class
     */
    abstract protected function getIterator(...$params);

    /**
     * @test
     * @group InfiniteIterator::__construct
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^Argument 1 passed to [\\\w]+::__construct\(\) must implement interface Iterator, array given/
     */
    public function testConstructorWithInvalidArgumentException()
    {
        $this->getIterator(array());
    }

    /**
     * @test
     * @group InfiniteIterator::next
     */
    public function testNextWillRestartAfterEnd()
    {
        $array = new \ArrayIterator(['a', 'b']);
        $infinite = $this->getIterator($array);

        $infinite->rewind(); // a
        $infinite->next(); // b
        $infinite->next(); // a
        $this->assertTrue($infinite->valid());
        $this->assertEquals('a', $infinite->current());
    }

    /**
     * @test
     * @group InfiniteIterator::next
     */
    public function testWithEmptyIterator()
    {
        $empty = new \EmptyIterator();
        $infinite = $this->getIterator($empty);

        $infinite->rewind();
        $this->assertFalse($infinite->valid());
    }
}

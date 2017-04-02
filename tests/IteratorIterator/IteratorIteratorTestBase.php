<?php

namespace tomtomsen\Iterators\tests\IteratorIterator;

use tomtomsen\Iterators\tests\IteratorTestBase;

abstract class IteratorIteratorTestBase extends IteratorTestBase
{
    /**
     * @test
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^Argument 1 passed to [\w\\]+::__construct\(\) must implement interface Traversable, \w+ given/
     */
    public function testConstructorWithInvalidArgument()
    {
        $this->getIterator([1, 2, 3]);
    }

    /**
     * @test
     */
    public function testGetInnerIterator()
    {
        $arrayIterator = new \ArrayIterator([1, 2, 3]);
        $iterator = $this->getIterator($arrayIterator);

        $this->assertEquals($arrayIterator, $iterator->getInnerIterator());
    }

    /**
     * @test
     */
    public function testIteration()
    {
        $array = [1, 2, 3];
        $arrayIterator = new \ArrayIterator($array);
        $iterator = $this->getIterator($arrayIterator);

        $iterator->rewind();
        $this->assertEquals(1, $iterator->current());

        $idx = 0;
        foreach ($iterator as $element) {
            $this->assertEquals($array[$idx++], $element);
        }
    }

    public function testEmptyIterator()
    {
        $empty = new \EmptyIterator();
        $iterator = $this->getIterator($empty);

        $this->assertNotEmpty($iterator);
        $iterator->rewind();
        $this->assertNull($iterator->current());
        $this->assertFalse($iterator->valid());
    }
}

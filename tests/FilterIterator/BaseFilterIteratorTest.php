<?php

namespace tomtomsen\Iterators\tests\FilterIterator;

abstract class BaseFilterIteratorTest extends \PHPUnit\Framework\TestCase
{
    abstract protected function getIterator(...$params);

    public function testGetInnerIterator()
    {
        $empty = new \EmptyIterator();
        $iterator = $this->getIterator($empty);

        $this->assertEquals($empty, $iterator->getInnerIterator());
    }

    public function testFilteredValues()
    {
        $array = new \ArrayIterator([-1, 0, 1, 2]);
        $iterator = $this->getIterator($array);

        $expected = [1, 2];
        $i = 0;
        foreach ($iterator as $value) {
            $this->assertEquals($expected[$i++], $value);
        }
    }

    public function testFilterEmptyIterator()
    {
        $empty = new \EmptyIterator();
        $iterator = $this->getIterator($empty);

        foreach ($iterator as $value) {
            $this->fail('not expected');
        }

        $this->assertNotEmpty($iterator);
    }

    /**
     * @test
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^Argument 1 passed to [\w\\]+::__construct\(\) must implement interface Iterator, \w+ given/
     */
    public function testConstructInvalidArgument()
    {
        $this->getIterator(7);
    }
}

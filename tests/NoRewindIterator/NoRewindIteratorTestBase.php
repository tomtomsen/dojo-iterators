<?php

namespace tomtomsen\Iterators\tests\NoRewindIterator;

use tomtomsen\Iterators\tests\IteratorTestBase;

/**
 * @group NoRewindIterator
 */
abstract class NoRewindIteratorTestBase extends IteratorTestBase
{
    /**
     * @test
     * @group NoRewindIterator::__construct
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^Argument 1 passed to [\\\w]+::__construct\(\) must implement interface Iterator, array given/
     */
    public function testConstructorWithInvalidArgument()
    {
        $this->getIterator([]);
    }

    public function testRewind()
    {
        $array = new \ArrayIterator(['a', 'b', 'c']);
        $noRewind = $this->getIterator($array);

        $noRewind->rewind();
        $noRewind->next();

        $this->assertEquals('b', $noRewind->current());
        $noRewind->rewind();
        $this->assertEquals('b', $noRewind->current());
    }
}

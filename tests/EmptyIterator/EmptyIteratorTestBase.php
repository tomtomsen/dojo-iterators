<?php

namespace tomtomsen\Iterators\tests\EmptyIterator;

use tomtomsen\Iterators\tests\IteratorTestBase;

abstract class EmptyIteratorTestBase extends IteratorTestBase
{
    /**
     * @test
     * @group EmptyIterator::valid
     */
    public function testValid()
    {
        $iterator = $this->getIterator();

        $this->assertFalse($iterator->valid());
    }

    /**
     * @test
     * @group EmptyIterator::next
     */
    public function testNext()
    {
        $iterator = $this->getIterator();

        $iterator->rewind();
        $iterator->next();
        $this->assertFalse($iterator->valid());
    }

    /**
     * @test
     * @group EmptyIterator::current
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessageRegExp /^Accessing the value of an EmptyIterator$/
     */
    public function testCurrentThrowsException()
    {
        $iterator = $this->getIterator();

        $iterator->rewind();
        $iterator->current();
    }

    /**
     * @test
     * @group EmptyIterator::key
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessageRegExp /^Accessing the key of an EmptyIterator$/
     */
    public function testKey()
    {
        $iterator = $this->getIterator();

        $iterator->key();
    }
}

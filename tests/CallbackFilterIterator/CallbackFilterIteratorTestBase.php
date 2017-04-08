<?php

namespace tomtomsen\Iterators\tests\CallbackFilterIterator;

use tomtomsen\Iterators\tests\IteratorTestBase;

/**
 * @group CallbackFilterIterator;
 */
abstract class CallbackFilterIteratorTestBase extends IteratorTestBase
{
    /**
     * @test
     * @group CallbackFilterIterator::__construct::$iterator
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^Argument 1 passed to [\\\w]+::__construct\(\) must implement interface Iterator, array given/
     */
    public function testConstructorIteratorInvalidArgument()
    {
        $this->getIterator([], function () {
        });
    }

    /**
     * @test
     * @group CallbackFilterIterator::__construct::$callback
     * @expectedException \TypeError
     * @expectedExceptionMessageRegExp /^[\\\w]+::__construct\(\) expects parameter 2 to be a valid callback, function 'string' not found or invalid function name/
     */
    public function testConstructorCallbackInvalidArgument()
    {
        $empty = new \EmptyIterator();
        $this->getIterator($empty, 'string');
    }

    /**
     * @test
     * @group CallbackFilterIterator::accept
     */
    public function testCallback()
    {
        $array = new \ArrayIterator(['a' => '-1', 'b' => '0', 'c' => '1', 'd' => '2']);
        $iterator = $this->getIterator($array, function ($value) {
            return 0 < $value;
        });

        $expectedValues = ['1', '2'];
        $expectedKeys = ['c', 'd'];
        $i = 0;
        foreach ($iterator as $key => $value) {
            $this->assertEquals($expectedKeys[$i], $key);
            $this->assertEquals($expectedValues[$i++], $value);
        }
    }
}

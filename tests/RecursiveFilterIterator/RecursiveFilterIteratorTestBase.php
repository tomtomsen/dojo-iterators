<?php

namespace tomtomsen\Iterators\tests\RecursiveFilterIterator;

use tomtomsen\Iterators\tests\IteratorTestBase;
use tomtomsen\Iterators\tests\RecursiveFilterIterator\RecursiveFilterIteratorImpl;

abstract class RecursiveFilterIteratorTestBase extends IteratorTestBase
{
    public function testUsage()
    {
        $array = new \RecursiveArrayIterator([
            'a' => [-1, 0, 1],
            'b' => ['x' => -2, 'y' => 2],
            [-4, -3, 3, 4],
        ]);
        $recursive = new \RecursiveIteratorIterator($this->getIterator($array));

        $expectedValues = [1, 2, 3, 4];
        $expectedKeys = [2, 'y', 2, 3];
        $i = 0;
        foreach ($recursive as $key => $item) {
            $this->assertEquals($expectedValues[$i], $item);
            $this->assertEquals($expectedKeys[$i++], $key);
        }

        $this->assertEquals(count($expectedValues), $i);
    }
}

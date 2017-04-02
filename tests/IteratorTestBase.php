<?php

namespace tomtomsen\Iterators\tests;

abstract class IteratorTestBase extends \PHPUnit_Framework_TestCase
{
    abstract protected function getIterator(...$params);
}

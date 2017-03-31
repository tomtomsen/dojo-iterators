<?php

namespace tomtomsen\Iterators\tests\FilterIterator;

class OriginalFilterIteratorImpl extends \FilterIterator
{
    public function accept()
    {
        $value = $this->getInnerIterator()->current();

        return 0 < $value;
    }
}

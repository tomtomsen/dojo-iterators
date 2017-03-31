<?php

namespace tomtomsen\Iterators\tests\FilterIterator;

use tomtomsen\Iterators\FilterIterator;

class FilterIteratorImpl extends FilterIterator
{
    public function accept()
    {
        $value = $this->getInnerIterator()->current();

        return 0 < $value;
    }
}

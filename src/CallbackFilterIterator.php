<?php

namespace tomtomsen\Iterators;

class CallbackFilterIterator extends FilterIterator implements \OuterIterator
{
    private $callback;

    public function __construct($iterator, $callback)
    {
        if (!is_callable($callback) && !$callback instanceof \Closure) {
            throw new \TypeError(__CLASS__.'::__construct() expects parameter 2 to be a valid callback, function \''.gettype($callback).'\' not found or invalid function name');
        }

        parent::__construct($iterator);

        $this->callback = $callback;
    }

    public function accept()
    {
        return (bool) call_user_func_array($this->callback, [$this->current()]);
    }
}

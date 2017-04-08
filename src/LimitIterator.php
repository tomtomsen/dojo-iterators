<?php

namespace tomtomsen\Iterators;

// require_once __DIR__ . '/../../IteratorIterator/src/IteratorIterator.php';

/**
 * @group \LimitIterator
 */
class LimitIterator extends IteratorIterator implements \OuterIterator
{
    private $position;
    private $offset;
    private $count;

    public function __construct($iterator, $offset = 0, $count = -1)
    {
        if (!$iterator instanceof \Iterator) {
            throw new \TypeError('Argument 1 passed to '.__CLASS__.'::__construct() must implement interface Iterator, '.gettype($iterator).' given');
        }

        if (!is_int($offset)) {
            throw new \TypeError(''.__CLASS__.'::__construct() expects parameter 2 to be integer, '.gettype($offset).' given');
        } elseif (0 > $offset) {
            throw new \OutOfRangeException('Parameter offset must be >= 0');
        }

        if (!is_int($count)) {
            throw new \TypeError(''.__CLASS__.'::__construct() expects parameter 3 to be integer, '.gettype($count).' given');
        } elseif (-1 > $count) {
            throw new \OutOfRangeException('Parameter count must either be -1 or a value greater than or equal 0');
        }

        parent::__construct($iterator);

        $this->offset = $offset;
        $this->position = 0;
        $this->count = $count;
    }

    public function getPosition() /* : int */
    {
        return $this->position;
    }

    public function seek($position) /* : int */
    {
        if (!is_numeric($position)) {
            trigger_error(''.__CLASS__.'::seek() expects parameter 1 to be integer, '.gettype($position).' given', E_USER_WARNING);
        } elseif ($position < 0) {
            throw new \OutOfBoundsException('Cannot seek to '.$position.' which is below the offset 0');
        }

        parent::rewind();
        $this->position = 0;
        for ($i = $position; $i-- && parent::valid();) {
            parent::next();
            $this->position++;
        }

        if (!parent::valid()) {
            throw new \OutOfBoundsException('Seek position '.(string) $position.' is out of range');
        }

        return $this->getPosition();
    }

    public function rewind()
    {
        parent::rewind();

        $this->seek($this->offset);
    }

    public function next()
    {
        $this->position++;
        parent::next();
    }

    public function valid()
    {
        if ($this->count > -1 && $this->offset + $this->count <= $this->position) {
            return false;
        }

        return parent::valid();
    }
}

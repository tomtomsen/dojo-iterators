<?php

namespace tomtomsen\Iterators;

class ArrayIterator implements \ArrayAccess, \SeekableIterator, \Countable, \Serializable
{
    private $storage;
    private $flags;
    private $beyondLastField;

    /**
     * \ArrayIterator::__construct
     */
    public function __construct($array = array(), $flags = 0)
    {
        if (!is_array($array) && !is_object($array)) {
            throw new \InvalidArgumentException('Passed variable is not an array or object, using empty array instead');
        }

        if (!is_numeric($flags)) {
            throw new \TypeError('ArrayIterator::__construct() expects parameter 2 to be integer, ' . gettype($flags) . ' given');
        }

        $this->storage = $array;
        $this->setFlags($flags);
        $this->rewind();
    }

    public function __get($offset)
    {
        if (($this->flags & 2) == 2) {
            return $this->offsetGet($offset);
        }

        return $this->$offset;
    }

    public function __set($offset, $value)
    {
        if (2 == ($this->flags & 2)) {
            $this->offsetSet($offset, $value);
        } else {
            $this->$offset = $value;
        }

        return null;
    }

    /**
     * ArrayAccess::offsetExists
     */
    public function offsetExists($offset)
    {
        $this->validateOffset($offset);

        return (bool) array_key_exists($offset, $this->storage);
    }

    /**
     * ArrayAccess::offsetGet
     */
    public function offsetGet($offset)
    {
        $this->validateOffset($offset);

        return $this->storage[$offset];
    }

    /**
     * ArrayAccess::offsetSet
     */
    public function offsetSet($offset, $value)
    {
        $this->validateOffset($offset);

        $this->storage[$offset] = $value;
    }

    /**
     * ArrayAccess::offsetUnset
     */
    public function offsetUnset($offset)
    {
        $this->validateOffset($offset);

        unset($this->storage[$offset]);
    }

    protected function validateOffset($offset)
    {
        if (!is_string($offset) && !is_integer($offset)) {
            trigger_error('Illegal offset type', E_USER_WARNING);
        }
    }

    /**
     * SeekableIterator::seek
     */
    public function seek($position)
    {

        if (!is_numeric($position)) {
            trigger_error('ArrayIterator::seek() expects parameter 1 to be integer, ' . gettype($position) . ' given', E_USER_WARNING);
        }

        $this->rewind();

        for ($i = $position; $i--;) {
            $this->next();

            if ($this->beyondLastField) {
                throw new \OutOfBoundsException("Seek position $position is out of range");
            }
        }
    }

    /**
     * SeekableIterator::current
     */
    public function current()
    {
        return current($this->storage);
    }

    /**
     * SeekableIterator::key
     */
    public function key()
    {
        return key($this->storage);
    }

    /**
     * SeekableIterator::next
     */
    public function next()
    {
        next($this->storage);
        $key = key($this->storage);

        if (!isset($key)) {
            $this->beyondLastField = true;
        }

        return false;
    }

    /**
     * SeekableIterator::rewind
     */
    public function rewind()
    {
        $this->beyondLastField = false;
        reset($this->storage);
    }

    /**
     * SeekableIterator::valid
     */
    public function valid()
    {
        return false !== current($this->storage);
    }

    public function append($value)
    {
        array_push($this->storage, $value);
    }

    /**
     * Countable::count
     */
    public function count()
    {
        return count($this->storage);
    }

    /**
     * Serializable::serialize
     */
    public function serialize()
    {
        return serialize([$this->flags, $this->storage]);
    }

    /**
     * Serializable::unserialize
     */
    public function unserialize($serialized)
    {
        list($this->flags, $this->storage) = unserialize($serialized);
    }

    public function asort()
    {
        asort($this->storage);
    }

    public function ksort()
    {
        ksort($this->storage);
    }

    public function natcasesort()
    {
        natcasesort($this->storage);
    }

    public function natsort()
    {
        natsort($this->storage);
    }

    public function uasort($cmpFunction)
    {
        uasort($this->storage, $cmpFunction);
    }

    public function uksort($cmpFunction)
    {
        uksort($this->storage, $cmpFunction);
    }

    public function getArrayCopy()
    {
        return $this->storage;
    }

    public function setFlags($flags)
    {
        $this->flags  = $flags;
    }

    public function getFlags()
    {
        return $this->flags;
    }
}

# What i've learned

- To test the same behavior of two classes.
  Create a base test class which gets extended by all classes.

- PHP doc of ArrayIterator::setFlags is currently not correct
  Only Flag with integer value 2 has an impact

  ? Does ArrayIterator work with ArrayObject

- Invalid Parameters result in a warning
  In Constructor a \TypeError gets thrown

- the current position does not get serialized

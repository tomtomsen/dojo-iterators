<?php

spl_autoload_register(function ($class) {
	if ('tomtomsen\\Iterators' !== substr($class, 0, 19)) {
		return false;
	}

	$class = strtr(substr($class, 20), array('\\' => '/'));

	if (false !== strpos($class, 'tests/')) {
		include __DIR__ . '/../' . $class . '.php';
	} else {
		include __DIR__ . '/../src/' . $class . '.php';
	}
});

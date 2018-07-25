<?php
/**
 * The autoloader 
 * @param string $class The class to instanciate
 * @return void
 */
function loadClass($class) {
	require_once $class . '.class.php';
}
spl_autoload_register('loadClass');

<?php
// All about the errors 
require_once 'errors.php';
set_error_handler('error2exception');

/**
 * The autoloader 
 * @param string $class The class to instanciate
 * @return void
 */
function loadClass($class) {
	require_once $class . '.class.php';
}
spl_autoload_register('loadClass');


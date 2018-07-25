<?php
set_error_handler('error2exception');
/**
 * Return a beautiful string that explains to you exactly what you failed.
 * @param Exception $e The exception.
 * @param bool $devMode If true, the exception will print more informations : type, line...
 * @return void
 */
function catchException(Exception $e, $devMode) {
	if ($devMode) {
		echo '<strong> ' . get_class($e) . '</strong> : an error occured in <strong>' . $e->getFile() . '</strong> on line <strong>' . $e->getLine() . '</strong>: <i>' . $e->getMessage() . '</i><br />'; 
	} else {
		echo '<strong>' . $e->getMessage() . '</strong><br />';
	}
}
/**
 * Send the paremeters of the PHP error to our MyException class
 * @param int $code
 * @param string $message
 * @param string $file
 * @param int $line
 * @return void
 */
function error2exception($code, $message, $file, $line) {
	throw new MyException($message, 0, $code, $fichier, $line);
}
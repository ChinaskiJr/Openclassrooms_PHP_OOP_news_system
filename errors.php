<?php
/**
 * Return a beautiful string that explains to you exactly what you failed.
 * @param Exception $e The exception.
 * @return void
 */
function catchException(Exception $e) {
	echo 'An error occured in <strong>' . $e->getFile() . '</strong> on line <strong>' . $e->getLine() . '</strong>: <br />' . $e->getMessage(); 
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
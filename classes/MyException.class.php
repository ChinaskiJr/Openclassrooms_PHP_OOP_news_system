<?php
/**
 * Inherits from ErrorException in order to convert PHP errors into exceptions
 */
class MyException extends ErrorException {
	/**
	 * adapt the string in function of the severity of the error.
	 * @return string The MyException error message.
	 */
	public function __toString() {
		switch ($this->severity) {
		    case E_USER_ERROR :
		        $type = 'Fatal Error';
		        break;
		    case E_WARNING :
		    case E_USER_WARNING :
		        $type = 'Warning';
		        break;
		    case E_NOTICE :
		    case E_USER_NOTICE :
		        $type = 'Notice';
		        break;
		    default :
		        $type = 'Uknown Error';
		        break;
		}
		return 'A <strong>' . $type . '</strong> occured in <strong>' . $this->file . '</strong> on line <strong>' . $this->line . '</strong>: <br />' . $this->message; 
	}
}
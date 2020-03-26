<?php

namespace App\Exceptions;

use Classes\Exception\SystemException;

class HelperException extends SystemException
{
    protected $title = 'Fatal Error!';
    protected $message = 'Couldnt load helper';
    protected $file;
    protected $line;
    protected $code = 0;
    protected $severity = 100;

    public function __construct($message = null)
    {
        if ($message) {
            $this->message = $message;
        }
        parent::__construct($this->message, $this->code, $this->severity, $this->file, $this->line);
    }
}

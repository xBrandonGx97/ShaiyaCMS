<?php

namespace App\Exceptions;

use Classes\Exception\SystemException;

class ConfigException extends SystemException
{
    protected $title = 'Fatal Error!';
    protected $message = 'Couldnt load config';
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

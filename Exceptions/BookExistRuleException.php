<?php

class BookExistRuleException extends Exception
{
    public function __construct($message = "", $code = 0,  $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $error = "in file : ".$this->file ." on line " . $this->line." =>> " . $this->message;
        echo $error;

        $log = new Log();
        $log($error);

        exit();
    }
}
<?php

class Log
{
    public function __invoke( $error , $file = 'Log\logs.txt')
    {
        $current = file_get_contents($file);

        $current .= $error."\n";

        file_put_contents($file, $current);
    }
}
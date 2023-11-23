<?php

require_once("Rules\Rule.php");
require_once("Exceptions\RequireException.php");

class RequireRule implements Rule
{
    public function validate($params, $key)
    {
        if (!key_exists($key, $params) || is_null($params[$key])) {
            new RequireException($key . " : This field is require");
        }
    }

}
<?php

require_once("Rules\Rule.php");
require_once("Exceptions\IntegerRuleException.php");

class IntegerRule implements Rule
{
    public function validate($params, $key)
    {
        if(key_exists($key , $params)) {
            if (!is_integer($params[$key])) {
                new IntegerRuleException($key . " : This field is integer");
            }
        }
    }
}
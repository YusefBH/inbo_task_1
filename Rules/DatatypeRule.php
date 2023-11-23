<?php

require_once("Rules\Rule.php");
require_once("Exceptions\DatatypeRuleException.php");

class DatatypeRule implements Rule
{
    public function validate($params, $key)
    {
        if($params[$key] != "json" and $params[$key] != "csv")
        {
            new RequireException($key . " : This field must be Json or Csv");
        }
    }
}
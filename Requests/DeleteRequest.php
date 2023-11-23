<?php

require_once("Requests\Request.php");
require_once("Rules\RequireRule.php");
require_once("Rules\IntegerRule.php");
require_once("Rules\DatatypeRule.php");

class DeleteRequest extends Request
{
    public function __construct($params)
    {
        parent::__construct($params);
    }


    public function rules($request)
    {
        $rules = [
            "type" =>[new RequireRule()],
            "value" => [new RequireRule()]
        ];

        $this->validate($rules);
    }
}
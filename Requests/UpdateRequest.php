<?php

require_once("Requests\Request.php");
require_once("Rules\RequireRule.php");
require_once("Rules\IntegerRule.php");
require_once("Rules\DatatypeRule.php");

class UpdateRequest extends Request
{
    public function __construct($params)
    {
        parent::__construct($params);
    }

    public function rules($request)
    {
        $rules = [
            "type" => [new RequireRule()],
            "value" => [new RequireRule()],
            "change_type" => [new RequireRule()],
            "change_value" => [new RequireRule()]
        ];

        $this->validate($rules);
    }
}
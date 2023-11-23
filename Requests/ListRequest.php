<?php

require_once("Requests\Request.php");
require_once("Rules\RequireRule.php");
require_once("Rules\IntegerRule.php");
require_once("Rules\DatatypeRule.php");


class ListRequest extends Request
{

    public function __construct($params)
    {
        parent::__construct($params);
    }

    public function rules()
    {
        $rules = [
            "pre_page" => [new RequireRule() , new IntegerRule()],
            "page_number" => [new RequireRule() , new IntegerRule()],
            "sort" => [new RequireRule()],
            "filter_by"=> [],
            "value"=> []
        ];

        $this->validate($rules);
    }
}
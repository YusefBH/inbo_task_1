<?php

require_once("MyValidate.php");

class ListRequest
{

    public function rules($request)
    {
        $rules = [
            "pre_page" => "require",
            "page_number" => "require",
            "sort" => "require",
            "filter_by"=> "",
            "value"=> "require"
        ];

        $val = new MyValidate( );
        $val($request ,$rules);
    }
}
<?php

class DeleteRequest
{
    public function rules($request)
    {
        $rules = [
            "pre_page" => "require",
            "page_number" => "require",
            "id" => "require"
        ];

        $val = new MyValidate( );
        $val($request ,$rules);
    }
}
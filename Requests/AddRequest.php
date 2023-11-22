<?php

class AddRequest
{
    public function rules($request)
    {
        $rules = [
            "type" => "datatype",
            "books" => "require",
        ];

        $val = new MyValidate( );
        $val($request ,$rules);
    }
}
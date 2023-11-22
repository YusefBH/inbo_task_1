<?php

class DeleteRequest
{
    public function rules($request)
    {
        $rules = [
            "type" =>"require",
            "value" => "require"
        ];

        $val = new MyValidate( );
        $val($request ,$rules);
    }
}
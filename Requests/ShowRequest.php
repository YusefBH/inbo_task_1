<?php

class ShowRequest
{
    public function rules($request)
    {
        $rules = [
            "id" => "require"
        ];

        $val = new MyValidate( );
        $val($request ,$rules);
    }
}
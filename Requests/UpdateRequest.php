<?php

class UpdateRequest
{
    public function rules($request)
    {
        $rules = [
            "type" => "require",
            "value" => "require",
            "change_type" => "require",
            "change_value" => "require"
        ];

        $val = new MyValidate();
        $val($request, $rules);
    }
}
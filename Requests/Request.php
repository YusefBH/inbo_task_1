<?php

abstract class Request
{

    protected $param = [];

    public function __construct($params)
    {
        foreach ($params as $key => $param) {
            $this->param[$key] = $param;
        }
    }

    public function validate($rules)
    {
        foreach ($rules as $key => $rule) {
            /** @var Rule $item */
            foreach ($rule as $item) {
                $item->validate($this->param , $key);
            }
        }
    }
}
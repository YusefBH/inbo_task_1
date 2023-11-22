<?php

class MyValidate
{
    public function __invoke($request , $rules)
    {
        foreach ($rules as $key => $rule) {

            if($rule == "require")
            {
                if(!key_exists($key , $request)){
                    var_dump($key." is Undefined !!!");
                    exit();
                }
                if(is_null($request[$key]))
                {
                    echo "<br>";
                    var_dump($key. " is null !!!!!!!!!!!!");
                    echo "<br>";
                }
            }
        }
    }
}
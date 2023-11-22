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
                    exit();
                }
            }

            if($rule == "datatype")
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
                    exit();
                }
                if($request[$key] != "json" and $request[$key] != "csv")
                {
                    echo "<br>";
                    var_dump("valid datatype is : json and csv !!!!!!!!!!!! but you given ".$request[$key]);
                    echo "<br>";
                    exit();
                }
            }
        }
    }
}
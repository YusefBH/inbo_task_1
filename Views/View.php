<?php

class View
{

    public function __invoke($obj , $param)
    {
        /** @var ViewInterface $obj */
        /** @var array $param */
        $obj->run($param);
    }
}
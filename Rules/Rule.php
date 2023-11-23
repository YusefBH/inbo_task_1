<?php

interface Rule
{
    public function validate($params, $key);
}
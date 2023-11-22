<?php

interface Database
{
    public function read($filter_by , $value);

    public function add($book);

    public function delete($id);
}
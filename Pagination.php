<?php

class Pagination
{
    private $per_page;
    private $paginated = [];
    public function __construct($per_page)
    {
        $this->per_page = $per_page ;
    }

    public function paginate($books , $page_number)
    {
        $i =0 ;
        $temp_array = [];
        $flag =1;
        foreach ($books as $book) {
            if($i>=$this->per_page){
                $this->paginated[] = $temp_array;
                $i =0 ;
                $temp_array = [];
                $flag =0;
            }
            $temp_array[$i++] = $book;
        }
        if($flag)
        {
            $this->paginated[] = $temp_array;
        }
        if(count($this->paginated)<=$page_number)
            return null;

        return $this->paginated[$page_number];
    }
}
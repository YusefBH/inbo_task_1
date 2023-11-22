<?php
require_once "database_class\Database.php";

class JsonDatabase implements Database
{

    public function read($filter_by , $value)
    {
        if(is_null($filter_by))
        {
            $books = json_decode(file_get_contents("database\books.json") , 1);
            $books = $books["books"];
        }else{
            $books = [];
            $all_books = json_decode(file_get_contents("database\books.json") , 1);
            $all_books = $all_books["books"];
            foreach ($all_books as $book) {
               if($book[$filter_by] == $value)
                   $books[] = $book;
            }
        }
       return $books;
    }
}
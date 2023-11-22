<?php
require_once "database_class\Database.php";

class JsonDatabase implements Database
{

    public function read($filter_by=null , $value=null)
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


        foreach ($books as &$book) {
            $d = DateTime::createFromFormat(
                'Y-m-d',
                 $book["publishDate"]
            );

            if ($d === false) {
                die("Incorrect date string");
            } else {
                $timestamp =  $d->getTimestamp();
            }
            $book["publishDate"] = date('y-m-d h:i:s', $timestamp);

        }
       return $books;
    }

    public function add($book)
    {
        $books = json_decode(file_get_contents("database\books.json") , 1);
        $books["books"][] = $book;
        $books = json_encode($books);

        $fp = fopen("database\books.json", 'w');
        fwrite($fp, $books);
        fclose($fp);


    }
}
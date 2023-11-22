<?php

require_once "my_databases.php";
require_once "database_class\JsonDatabase.php";
require_once "database_class\CsvDatabase.php";

class Book
{

    private function books(){
        $json_database = new JsonDatabase();
        $temp1 = $json_database->read();

        $csv_database = new CsvDatabase();
        $temp2 = $csv_database->read();
        $books = array_merge($temp1 , $temp2);

        return $books;
    }

    public function all_books($request)
    {

        $sort_type = $request["sort"];
        $filter_by = $request["filter_by"];
        $value = $request["value"];

        $json_database = new JsonDatabase();
        $temp1 = $json_database->read($filter_by , $value);

       $csv_database = new CsvDatabase();
       $temp2 = $csv_database->read($filter_by , $value);
       $books = array_merge($temp1 , $temp2);

        function compareByTimeStamp2($time1, $time2)
        {
            if (strtotime($time1["publishDate"]) < strtotime($time2["publishDate"]))
                return 1;
            else if ($time1["publishDate"] > $time2["publishDate"])
                return -1;
            else
                return 0;
        }
        function compareByTimeStamp1($time1, $time2)
        {
            if (strtotime($time1["publishDate"]) < strtotime($time2["publishDate"]))
                return -1;
            else if ($time1["publishDate"] > $time2["publishDate"])
                return 1;
            else
                return 0;
        }
        if($sort_type == "asc"){
            usort($books , "compareByTimeStamp1");
        }else{
            usort($books , "compareByTimeStamp2");
        }

       return $books;
    }

    public function specific_book($id)
    {
        foreach ($this->books() as $book) {
            if($book['ISBN'] == $id)
            {
                return $book;
            }
        }
        return null;
    }

    public function add_books($request)
    {
        if($request["type"] == "json"){
            //todo: validate books
            foreach ($request["books"] as $book) {
                $json_database = new JsonDatabase();
                $json_database->add($book);
            }
        }else{
            //todo: validate books
            $csv_database = new CsvDatabase();
            $csv_database->add($request["books"]);
        }
    }
}
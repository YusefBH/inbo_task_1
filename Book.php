<?php


require_once "database_class\JsonDatabase.php";
require_once "database_class\CsvDatabase.php";

class Book
{

    private function books()
    {
        $json_database = new JsonDatabase();
        $temp1 = $json_database->read();

        $csv_database = new CsvDatabase();
        $temp2 = $csv_database->read();
        $books = array_merge($temp1, $temp2);
        return $books;
    }

    public function all_books($request)
    {
        $sort_type = $request["sort"];
        $filter_by = $request["filter_by"];
        $value = $request["value"];

        $json_database = new JsonDatabase();
        $temp1 = $json_database->read($filter_by, $value);

        $csv_database = new CsvDatabase();
        $temp2 = $csv_database->read($filter_by, $value);

        $books = array_merge($temp1, $temp2);

        function desc($time1, $time2)
        {
            if (strtotime($time1["publishDate"]) < strtotime($time2["publishDate"]))
                return 1;
            else if ($time1["publishDate"] > $time2["publishDate"])
                return -1;
            else
                return 0;
        }

        function asc($time1, $time2)
        {
            if (strtotime($time1["publishDate"]) < strtotime($time2["publishDate"]))
                return -1;
            else if ($time1["publishDate"] > $time2["publishDate"])
                return 1;
            else
                return 0;
        }

        if ($sort_type == "asc") {
            usort($books, "asc");
        } else {
            usort($books, "desc");
        }

        return $books;
    }

    public function specific_book($id)
    {
        foreach ($this->books() as $book) {
            if ($book['ISBN'] == $id) {
                return $book;
            }
        }
        return null;
    }

    public function add_books($request)
    {
        foreach ($request["books"] as $book) {
            $json_database = new JsonDatabase();
            $json_database->add($book);

            $csv_database = new CsvDatabase();
            $csv_database->add($book);
        }
    }

    public function remove_book($id)
    {
        $json_database = new JsonDatabase();
        $json_database->delete($id);
        $csv_database = new CsvDatabase();
        $csv_database->delete($id);
    }

    public function update_book($id, $request)
    {
        $json_database = new JsonDatabase();
        $json_database->update($id, $request);
        $csv_database = new CsvDatabase();
        $csv_database->update($id, $request);
    }
}
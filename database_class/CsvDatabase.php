<?php

require_once "database_class\Database.php";
class CsvDatabase implements Database
{

    public function read($filter_by =null , $val=null)
    {
        $array = [];

        if(is_null($filter_by))
        {
            $handle = fopen("database\books.csv", "r");
            if($handle){
                $line = fgets($handle);
            }
            $key_array = explode("," , $line);
            array_pop($key_array);
            if ($handle) {
                $i = 0;
                while (($line = fgets($handle)) !== false and ++$i>0) {
                    $value = explode("," , $line);
                    array_pop($value);
                    $array[] = array_combine($key_array , $value);
                }
                fclose($handle);
            }
        }else{
            $handle = fopen("database\books.csv", "r");
            if($handle){
                $line = fgets($handle);
            }
            $key_array = explode("," , $line);
            array_pop($key_array);
            if ($handle) {
                $i = 0;
                while (($line = fgets($handle)) !== false and ++$i>0) {
                    $value = explode("," , $line);
                    array_pop($value);
                    $x =  array_combine($key_array , $value);

                    if($x[$filter_by] == $val) {
                        $array[] = $x;
                    }
                }
                fclose($handle);
            }
        }

        foreach ($array as &$book) {
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

        return $array;
    }

    public function add($book)
    {

        var_dump($book);
        $handle = fopen("database\books.csv", "r");

        if ($handle) {
            $line = fgets($handle);
        }

        $key_array = explode(",", $line);
        array_pop($key_array);

        $mybook = explode("," ,$book);
        array_pop($mybook);
        $mybook = array_combine($key_array , $mybook);

        if ($handle) {
            $i = 0;
            while (($line = fgets($handle)) !== false and ++$i > 0) {
                $value = explode(",", $line);
                array_pop($value);

                var_dump(count($key_array) , count($value));
                $array = array_combine($key_array, $value);

                if($array["ISBN"] == $mybook["ISBN"]){
                    var_dump("this book exist !!!!!!!!!!!!!!!");
                    exit();
                }
            }
            fclose($handle);
        }

        file_put_contents("database\books.csv", $book.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    public function delete($id)
    {
        $handle = fopen("database\books.csv", "r");

        $contents = file_get_contents("database\books.csv");


        if ($handle) {
            $line = fgets($handle);
        }

        $key_array = explode(",", $line);
        array_pop($key_array);
        if ($handle) {
            $i = 0;
            while (($line = fgets($handle)) !== false and ++$i > 0) {
                $value = explode(",", $line);
                array_pop($value);
                $array = array_combine($key_array, $value);
                if($array["ISBN"] == $id){
                    $contents = str_replace($line, '', $contents);

                }
            }
            fclose($handle);
        }
        file_put_contents("database\books.csv", $contents);
    }

    public function update($id , $request )
    {
        $handle = fopen("database\books.csv", "r");

        $contents = file_get_contents("database\books.csv");


        if ($handle) {
            $line = fgets($handle);
        }

        $key_array = explode(",", $line);
        array_pop($key_array);
        if ($handle) {
            $i = 0;
            while (($line = fgets($handle)) !== false and ++$i > 0) {
                $value = explode(",", $line);
                array_pop($value);
                $array = array_combine($key_array, $value);
                if($array["ISBN"] == $id){
                    $array[$request["change_type"]] = $request["change_value"];
                    $contents = str_replace($line, implode("," , $array)."\n", $contents);
                }
            }
            fclose($handle);
        }
        file_put_contents("database\books.csv", $contents);

    }
}
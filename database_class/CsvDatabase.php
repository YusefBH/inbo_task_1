<?php

require_once "database_class\Database.php";
class CsvDatabase implements Database
{

    public function read($filter_by =null , $value=null)
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
                    if($x[$filter_by] == $value)
                        $array[] = $x;
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
        file_put_contents("database\books.csv", $book , FILE_APPEND | LOCK_EX);
    }

    public function delete($id)
    {
        //todo: delete csv
    }
}
<?php

require_once "database_class\Database.php";
class CsvDatabase implements Database
{

    public function read($filter_by , $value)
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


        return $array;
    }

}
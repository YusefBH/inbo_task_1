<?php

require_once "database_class\Database.php";
require_once("Exceptions\BookExistRuleException.php");

class CsvDatabase implements Database
{

    public function read($filter_by = null, $val = null)
    {
        $array = [];

        $handle = fopen("database\books.csv", "r");
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
                if (is_null($filter_by)) {
                    $array[] = array_combine($key_array, $value);
                } else {
                    $x = array_combine($key_array, $value);

                    if ($x[$filter_by] == $val) {
                        $array[] = $x;
                    }
                }
            }
            fclose($handle);
        }

        foreach ($array as &$book) {
            $d = DateTime::createFromFormat(
                'Y-m-d',
                $book["publishDate"]
            );

            if ($d === false) {
                die("Incorrect date string");
            } else {
                $timestamp = $d->getTimestamp();
            }
            $book["publishDate"] = date('y-m-d h:i:s', $timestamp);

        }

        return $array;
    }

    public function add($book)
    {
        $handle = fopen("database\books.csv", "r");
        if ($handle)
            $line = fgets($handle);

        $key_array = explode(",", $line);
        array_pop($key_array);

        if ($handle) {
            $i = 0;
            while (($line = fgets($handle)) !== false and ++$i > 0) {
                $value = explode(",", $line);
                array_pop($value);

                $array = array_combine($key_array, $value);

                if ($array["ISBN"] == $book["ISBN"])
                    new BookExistRuleException("this book exist !");
            }
            fclose($handle);
        }
        $book = implode(",", $book) . ",";
        file_put_contents("database\books.csv", $book . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function delete($id)
    {
        $handle = fopen("database\books.csv", "r");
        $contents = file_get_contents("database\books.csv");

        if ($handle)
            $line = fgets($handle);

        $key_array = explode(",", $line);
        array_pop($key_array);
        if ($handle) {
            $i = 0;
            while (($line = fgets($handle)) !== false and ++$i > 0) {
                $value = explode(",", $line);
                array_pop($value);
                $array = array_combine($key_array, $value);
                if ($array["ISBN"] == $id)
                    $contents = str_replace($line, '', $contents);
            }
            fclose($handle);
        }
        file_put_contents("database\books.csv", $contents);
    }

    public function update($id, $request)
    {
        $handle = fopen("database\books.csv", "r");
        $contents = file_get_contents("database\books.csv");

        if ($handle)
            $line = fgets($handle);

        $key_array = explode(",", $line);
        array_pop($key_array);
        if ($handle) {
            $i = 0;
            while (($line = fgets($handle)) !== false and ++$i > 0) {
                $value = explode(",", $line);
                array_pop($value);
                $array = array_combine($key_array, $value);
                if ($array["ISBN"] == $id) {
                    $array[$request["change_type"]] = $request["change_value"];
                    $contents = str_replace($line, implode(",", $array) . "\n", $contents);
                }
            }
            fclose($handle);
        }
        file_put_contents("database\books.csv", $contents);
    }
}
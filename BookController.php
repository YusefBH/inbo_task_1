<?php

require_once("Requests\ListRequest.php");
require_once("Requests\ShowRequest.php");
require_once("Requests\AddRequest.php");
require_once("Requests\DeleteRequest.php");
require_once("Requests\UpdateRequest.php");
require_once ("Book.php");
require_once("Pagination.php");

class BookController
{
    public function list_($request)
    {
        $req = new ListRequest();
        $req->rules($request);

        $books = new Book();

        $books = $books->all_books($request);

        $paginate = new Pagination($request["pre_page"] );
        $x = $paginate->paginate($books , $request["page_number"]);
        echo "<pre>";
        print_r($x);
        echo "</pre>";
    }


    public function show($request)
    {
        $req = new ShowRequest();
        $req->rules($request);

        $book = new Book();

        $book = $book->specific_book($request["id"]);
        if($book) {
            echo "<pre>";
            print_r($book);
            echo "</pre>";
        }else{
            echo "404 error book dose not exist";
        }
    }

    public function add($request)
    {
        $req = new AddRequest();
        $req->rules($request);

        $book = new Book();
        $book = $book->add_books($request);
    }

    public function delete($request)
    {
        $req = new DeleteRequest();
        $req->rules($request);

        $book = new Book();
        if($request["type"] == "ISBN"){
            $book->remove_book($request["value"]);
        }else{
            $books = $book->all_books(["sort" => null , "filter_by" => $request["type"] , "value" => $request["value"]]);
            if (!empty($books)) {
                foreach ($books as $item) {
                    $book->remove_book($item["ISBN"]);
                }
            }
        }
    }

    public function Update($request)
    {
        $req = new UpdateRequest();
        $req->rules($request);

        $book = new Book();
        if($request["type"] == "ISBN"){
            $book->update_book($request["value"] ,$request);
        }else{
            $books = $book->all_books(["sort" => null , "filter_by" => $request["type"] , "value" => $request["value"]]);
            if (!empty($books)) {
                foreach ($books as $item) {
                    $book->update_book($item["ISBN"] , $request);
                }
            }
        }


        var_dump("inja update hast");
    }
}
<?php

require_once("Requests\ListRequest.php");
require_once("Requests\ShowRequest.php");
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

    public function delete($request)
    {
        $req = new DeleteRequest();
        $req->rules($request);
        var_dump("inja delete hast");
    }

    public function Update($request)
    {
        $req = new UpdateRequest();
        $req->rules($request);
        var_dump("inja update hast");
    }
}
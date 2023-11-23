<?php

class AddEachRequest extends Request
{
    public function __construct($params)
    {
        parent::__construct($params);
    }

    public function rules($request)
    {
        $rules = [
            "ISBN" => [new RequireRule()],
            "bookTitle" => [new RequireRule()],
            "authorName" => [new RequireRule()],
            "pagesCount" => [new RequireRule()],
            "publishDate" => [new RequireRule()]
        ];

        $this->validate($rules);
    }
}
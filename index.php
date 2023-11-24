<?php

require_once("BookController.php");

$commands = json_decode( file_get_contents("commands.json"), 1);




foreach ($commands as $command) {
        switch ($command["command_name"])
        {
            case "List" :
                $list = new BookController();
                $list->list_($command["parameters"]);
                break;

            case "Show" :
                $show = new BookController();
                $show->show($command["parameters"]);
                break;

            case "Add" :
                $list = new BookController();
                $list->add($command["parameters"]);
                break;

            case "Delete" :
                $delete = new BookController();
                $delete->delete($command["parameters"]);
                break;

            case "Update" :
                $Update = new BookController();
                $Update->Update($command["parameters"]);
                break;

            case "default" :
                echo "404";
        }
    break;
}

<?php

require_once("Views\ViewInterface.php");

class ShowView implements ViewInterface
{

    public function run($param)
    {
        ?>

        <!doctype html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport"
                  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
        </head>
        <style>
            .des {
                display: inline-block;
                margin: 2px;
            }

            .fou {
                padding: 0;
                color: #ffdd00;
                font-size: 14px;
            }

            .all {
                margin-top: 60px;
                background-color: rgb(70, 68, 68);
                border-radius: 20px;
                padding: 20px;
                width: 350px;
            }

            .center {
                margin: auto;
                width: 50%;
            }
        </style>
        <body>
        <div class="all">
            <div style="text-align: center; margin-top: 40px">
                <div>
                    <img src="Views/img/book.jpg" alt="book">
                    <h3 style="margin-bottom: 0; color: white"><?= $param["bookTitle"] ?></h3>
                    <p style="margin-top: 6px; margin-bottom: 50px;color: white"><?= $param["ISBN"] ?></p>
                </div>
            </div>

            <div class="center">
                <div style="text-align: center">
                    <div class="fou">Author : <p class="des"><?= $param["authorName"] ?></p></div>
                    <div class="fou">Pages : <p class="des"><?= $param["pagesCount"] ?></p></div>
                    <div class="fou">PublishDate : <p class="des"><?= $param["publishDate"] ?></p></div>
                </div>
            </div>

 </div>
        </div>
        </body>
        </html>

        <?php
    }
}
<?php
//home
$app->get('/', App\Controller\Home::class);
//upload
$app->any('/upload', App\Controller\File::class . ':upload');
//file overview
$app->any('/files/{file_id}', App\Controller\File::class . ':item');
$app->any('/sign', App\Controller\User::class . ':sign');
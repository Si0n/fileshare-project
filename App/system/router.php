<?php
//home
$app->get('/', App\Controller\Home::class);
//upload
$app->post('/upload', App\Controller\File::class . ':upload');
//files overview
$app->any('/files', function ($request, $response, $args) use ($app) {
    $this->{'App\Controller\File'}->files($request, $response, $args);
});
//file overview
$app->get('/files/{file_id}', function ($request, $response, $args) use ($app) {
    //Need to check file owner
    $this->{'App\Controller\File'}->files($request, $args);
});
<?php
//home
$app->get('/', function ($request, $response, $args) use ($app) {
    $this->{'App\Controller\Home'}->index($request, $response, $args);
});
//upload
$app->post('/upload', function ($request, $response, $args) use ($app) {
    $this->{'App\Controller\File'}->upload($request, $response, $args);
});
//files overview
$app->get('/files', function ($request, $response, $args) use ($app) {
    $this->{'App\Controller\File'}->index($request, $response, $args);
});
//file overview
$app->get('/files/{file_id}', function ($request, $response, $args) use ($app) {
    $this->{'App\Controller\File'}->index($request, $response, $args);
});
<?php
//home
$app->get('/', function ($request, $response, $args) {
    $x = $this->view;
});
//upload
$app->get('/upload', function ($request, $response, $args) {
    $x = $this->view;
});
//files overview
$app->get('/files', function ($request, $response, $args) {
    $x = $this->view;
});
//file overview
$app->get('/files/{file_id}', function ($request, $response, $args) {
    $x = $this->view;
});
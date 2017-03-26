<?php
//home
$app->get('/', function ($request, $response, $args) use ($app) {
    $this->{'App\Controller\Home'}->index($request, $response, $args);
});
//upload
$app->post('/upload', function ($request, $response, $args) use ($app) {
    $uploaded_files = $this->{'App\Controller\File'}->upload($request);
    if (empty($uploaded_files)) {
        $this->{'App\Controller\Home'}->index($request, $response, $args);
    } elseif(count($uploaded_files) == 1) {
       //Bad idead i guess // return $response->withRedirect('/files/'. current($uploaded_files)->getFileId());
    } else {

    }
});
//files overview
$app->any('/files', function ($request, $response, $args) use ($app) {
    $this->{'App\Controller\File'}->files($request, $response, $args);
});
//file overview
$app->get('/files/{file_id}', function ($request, $response, $args) use ($app) {
    //Need to check file owner
    $this->{'App\Controller\File'}->files($request, $args);
});
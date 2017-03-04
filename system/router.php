<?php
$app->get('/', function ($request, $response, $args) {
    $query = $this->db->query("SELECT * FROM routes WHERE 1");



    return $response->write("Hello, " . $args['name']);
});

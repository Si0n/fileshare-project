<?php
namespace App\Controller;

class Home extends Controller {

    public function index($request, $response, $args) {
        $this->container->view->render($response, 'layout.twig', [
            "document" => ["title" => "Home page",
                "styles" => ["/css/bootstrap.min.css", "/css/style.css"]],
            "upload" => "/upload"
        ]);
    }
}
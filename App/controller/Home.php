<?php
namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Home extends Controller {

    public function __invoke(Request $request, Response $response,  $args) {
    	$x = 0;
        $this->container->view->render($response, 'layout.twig', [
            "document" => ["title" => "Home page",
                "styles" => ["/css/bootstrap.min.css", "/css/style.css"]],
            "upload" => "/upload"
        ]);
    }
}
<?php

namespace App\Controller;

use Slim\App;
use Slim\Container;

abstract class Controller
{
    var $container;
    var $app;
    protected $html;

    public function __construct(Container $container, App $app)
    {
        $this->container = $container;
        $this->app = $app;
    }

    public function __get($var)
    {
        return $this->container->{$var};
    }
    abstract public function index($request, $response, $args);
}
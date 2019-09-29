<?php

namespace App\Controllers;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
class BaseController{
    protected $templateEngine;
    public function __construct()
    {
        $loader = new FilesystemLoader('../views');
        $this->templateEngine = new Environment($loader, [
            'debug' => true,
            'cache' => false,
        ]);
    }

    public function renderHTML($file, $data = []){
        return $this->templateEngine->render($file, $data);
    }
}

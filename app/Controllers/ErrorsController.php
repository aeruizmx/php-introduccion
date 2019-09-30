<?php

namespace App\Controllers;

class ErrorsController extends BaseController{
    
    public function error403(){
        return $this->renderHTML('error403.twig');
    }

}
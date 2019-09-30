<?php

namespace App\Controllers;

class AdminController extends BaseController{
    
    public function index(){
        return $this->renderHTML('admin.twig');
    }

}
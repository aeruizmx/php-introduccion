<?php

namespace App\Controllers;

use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response\RedirectResponse;

use App\Models\User;

class AdminController extends BaseController{
    
    public function index(){
        return $this->renderHTML('admin.twig');
    }

    public function change(){
        return $this->renderHTML('password.twig');
    }

    public function changePass(ServerRequest $request)
    {
        $id = $_SESSION['userId'];
        $requestData = $request->getParsedBody();

        $me = User::findOrFail($id);
        $me->password = password_hash($requestData['password'], PASSWORD_DEFAULT);
        $me->save();
       

        return new RedirectResponse('/admin');
    }
}
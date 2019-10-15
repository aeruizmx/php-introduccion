<?php

namespace App\Controllers;

use App\Models\User;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

class AuthController extends BaseController{
    
    public function index(){
        return $this->renderHTML('login.twig');
    }

    public function check(ServerRequest $request){
        $responseMessage = '';
        $postData = $request->getParsedBody();
        $user = User::where('email','=',$postData['email'])->first();
        if($user){
            if(\password_verify($postData['password'],$user->password)){
                $_SESSION['userId'] = $user->id;
                return new RedirectResponse('/admin');
            }else{
                $responseMessage = 'Credenciales incorrectas!';
            }
        }else{
            $responseMessage = 'Credenciales incorrectas!';
        }
        return $this->renderHTML('login.twig', ['responseMessage'=>$responseMessage]);
    }

    public function logout(){
        unset($_SESSION['userId']);
        return new RedirectResponse('/login');
    }
}
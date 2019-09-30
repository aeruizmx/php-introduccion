<?php

namespace App\Controllers;

use App\Models\User;
use Zend\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController{
    
    public function index(){
        return $this->renderHTML('login.twig');
    }

    public function check($request){
        $responseMessage = '';
        $postData = $request->getParsedBody();
        $user = User::where('email','=',$postData['email'])->first();
        if($user){
            if(\password_verify($postData['password'],$user->password)){
                return new RedirectResponse('/admin');
            }else{
                $responseMessage = 'Credenciales incorrectas!';
            }
        }else{
            $responseMessage = 'Credenciales incorrectas!';
        }
        return $this->renderHTML('login.twig', ['responseMessage'=>$responseMessage]);
    }
}
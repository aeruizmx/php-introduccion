<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController{
    
    public function index(){
        return $this->renderHTML('login.twig');
    }

    public function check($request){
        $postData = $request->getParsedBody();
        $user = User::where('email','=',$postData['email'])->first();
        if($user){
            if(\password_verify($postData['password'],$user->password)){
                echo 'Credenciales !';
            }else{
                echo 'Credenciales incorrectas!';
            }
        }else{
            echo 'Credenciales incorrectas!';
        }
        return $this->renderHTML('login.twig');
    }
}
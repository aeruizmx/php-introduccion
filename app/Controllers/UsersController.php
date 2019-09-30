<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;

use App\models\User;

class UsersController extends BaseController{
    
    public function create(){
        return $this->renderHTML('addUser.twig');
    }
    public function store($request){
        $responseMessage = '';
        if($request->getMethod() == 'POST'){
            $userValidator = v::key('email', v::email())
                                ->key('password', v::date()->notEmpty());
            $postData = $request->getParsedBody();
            try {
                $userValidator->validate($postData);
                $user = new User();
                $user->email = $postData['email'];
                $user->password = password_hash($postData['password'], PASSWORD_DEFAULT);
                $user->save();
                $responseMessage = 'Se guardo con exito!';
                
            } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
            }
            
        } 
        return $this->renderHTML('addUser.twig', ['responseMessage'=>$responseMessage]);
    }
}

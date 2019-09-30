<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;

use App\models\Job;

class JobsController extends BaseController{
    
    public function create(){
        return $this->renderHTML('addJob.twig');
    }
    public function store($request){
        $responseMessage = '';
        if($request->getMethod() == 'POST'){
            $jobValidator = v::key('title', v::stringType()->notEmpty())
                                ->key('description', v::date()->notEmpty());
            $postData = $request->getParsedBody();
            try {
                $jobValidator->assert($postData);
                $job = new Job();
                $job->title = $postData['title'];
                $job->description = $postData['description'];
                $job->months = $postData['months'];
                $job->visible = true;
                $job->save();
                $responseMessage = 'Se guardo con exito!';
            } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
            }
            
        } 
        return $this->renderHTML('addJob.twig', ['responseMessage'=>$responseMessage]);
    }
}

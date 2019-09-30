<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;

use App\models\Project;

class ProjectsController extends BaseController{
    
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
                $project = new Project();
                $project->title = $postData['title'];
                $project->description = $postData['description'];
                $project->months = $postData['months'];
                $project->visible = true;
                $project->save();
                $responseMessage = 'Se guardo con exito!';
            } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
            }
            
        }  
        return $this->renderHTML('addProject.twig', ['responseMessage'=>$responseMessage]);
    }
}
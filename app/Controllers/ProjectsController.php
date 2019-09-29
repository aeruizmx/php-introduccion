<?php

namespace App\Controllers;

use App\models\Project;

class ProjectsController extends BaseController{
    
    public function create(){
        echo $this->renderHTML('addJob.twig');
    }
    public function store($request){
        if($request->getMethod() == 'POST'){
            $postData = $request->getParsedBody();
            $project = new Project();
            $project->title = $postData['title'];
            $project->description = $postData['description'];
            $project->months = $postData['months'];
            $project->visible = true;
            $project->save();
        }  
        echo $this->renderHTML('addProject.twig');
    }
}
<?php

namespace App\Controllers;

use App\models\Project;

class ProjectsController{
    
    public function create(){
        include '../views/addProject.php';
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
        include '../views/addProject.php';
    }
}
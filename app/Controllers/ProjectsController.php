<?php

namespace App\Controllers;

use App\models\Project;

class ProjectsController{
    
    public function index(){
        if(!empty($_POST)){
            $project = new Project();
            $project->title = $_POST['title'];
            $project->description = $_POST['description'];
            $project->months = $_POST['months'];
            $project->visible = true;
            $project->save();
        }  
        include '../views/addProject.php';
    }
}
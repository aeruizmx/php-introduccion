<?php

namespace App\Controllers;

use App\models\Job;

class JobsController{
    
    public function index(){
        if(!empty($_POST)){
            $job = new Job();
            $job->title = $_POST['title'];
            $job->description = $_POST['description'];
            $job->months = $_POST['months'];
            $job->visible = true;
            $job->save();
        } 
        include '../views/addJob.php';
    }
}

<?php

namespace App\Controllers;

use App\models\Job;

class JobsController{
    
    public function create(){
        include '../views/addJob.php';
    }
    public function store($request){
        if($request->getMethod() == 'POST'){
            $postData = $request->getParsedBody();
            $job = new Job();
            $job->title = $postData['title'];
            $job->description = $postData['description'];
            $job->months = $postData['months'];
            $job->visible = true;
            $job->save();
        } 
        include '../views/addJob.php';
    }
}

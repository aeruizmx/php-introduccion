<?php

namespace App\Controllers;

use App\models\Job;

class JobsController extends BaseController{
    
    public function create(){
        return $this->renderHTML('addJob.twig');
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
        return $this->renderHTML('addJob.twig');
    }
}

<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Job;

class IndexController extends BaseController{
    
    public function index(){
        $jobs = Job::all();
        $projects = Project::all();
        $name = 'Andrés Ruiz';
        $limit_months = 2000;

        return $this->renderHTML('index.twig', [ 'name'=>$name, 'jobs'=>$jobs, 'projects'=>$projects]);
    }
}

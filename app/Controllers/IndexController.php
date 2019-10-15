<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Job;

class IndexController extends BaseController{
    
    public function index(){
        $jobs = Job::all();
        $projects = Project::all();
        // $limit_months = 1;
        // $filterFunction = function(array $job) use ($limit_months){
        //     return $job['months'] >= $limit_months;
        // };
        // $jobs = array_filter($jobs->toArray(), $filterFunction);
        $name = 'Andrés Ruiz';

        return $this->renderHTML('index.twig', [ 'name'=>$name, 'jobs'=>$jobs, 'projects'=>$projects]);
    }
}

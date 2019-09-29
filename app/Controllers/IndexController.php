<?php

namespace App\Controllers;

use App\Models\Project;
use App\Models\Job;

class IndexController{
    
    public function index(){
        $jobs = Job::all();
        $projects = Project::all();
        $name = 'Andrés Ruiz';
        $limit_months = 2000;

        include '../views/index.php';
    }
}

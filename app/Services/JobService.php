<?php
namespace App\Services;

use App\models\Job;

class JobService{
    public function deleteJob($id){
        $job = Job::findOrFail($id);
        $job->delete();
    }
}
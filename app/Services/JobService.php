<?php
namespace App\Services;

use App\models\Job;

class JobService{
    public function deleteJob($id){
        $job = Job::findOrFail($id);
        // if(!$job){
        //     throw new \Exception("Job not found");
        // }
        $job->delete();
    }
}
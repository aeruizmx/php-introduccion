<?php

namespace App\Controllers;

use Respect\Validation\Validator as v;

use App\models\Job;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

class JobsController extends BaseController{
    
    public function index(){
        $jobs = Job::all();
        return $this->renderHTML('jobs/index.twig', compact( 'jobs'));
    }

    public function delete(ServerRequest $request){
        $params = $request->getQueryParams();
        $job = Job::findOrFail($params['id']);
        $job->delete();
        return new RedirectResponse('/jobs');
    }

    public function create(){
        return $this->renderHTML('addJob.twig');
    }

    public function store($request){
        $responseMessage = '';
        if($request->getMethod() == 'POST'){
            $jobValidator = v::key('title', v::stringType()->notEmpty())
                                ->key('description', v::date()->notEmpty())
                                ->key('months', v::numeric());
            $postData = $request->getParsedBody();
            try {
                $jobValidator->validate($postData);
                $files = $request->getUploadedFiles();
                $logo = $files['logo'];
                if($logo->getError() == UPLOAD_ERR_OK) {
                    $fileName = $logo->getClientFilename();
                    $logo->moveTo("uploads/$fileName");
                    $filePath = "uploads/$fileName";
                    $job = new Job();
                    $job->title = $postData['title'];
                    $job->description = $postData['description'];
                    $job->months = $postData['months'];
                    $job->visible = true;
                    $job->file = $filePath;
                    $job->save();
                    $responseMessage = 'Se guardo con exito!';
                }else{
                    $responseMessage = $logo->getError();
                }
            } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
            }
            
        } 
        return $this->renderHTML('addJob.twig', ['responseMessage'=>$responseMessage]);
    }

    
}

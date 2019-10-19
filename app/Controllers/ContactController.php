<?php

namespace App\Controllers;

use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response\RedirectResponse;
use App\Models\Message;

class ContactController extends BaseController
{

    public function index()
    {
        return $this->renderHTML('contacts/index.twig');
    }

    public function send(ServerRequest $request)
    {
        $requestData = $request->getParsedBody();
        $message = new Message();
        $message->name = $requestData['name'];
        $message->email = $requestData['email'];
        $message->message = $requestData['message'];
        $message->send = false;
        $message->save();
       

        return new RedirectResponse('/contact');
    }
}

<?php
namespace App\Commands;

use App\Models\Message;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class SendMailCommand extends Command{
    protected static $defaultName = 'app:send-mail';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pendingMessage = Message::where('send',false)->first();
        if($pendingMessage){
            // Create the Transport
            $transport = (new Swift_SmtpTransport(getenv('SMTP_HOST'), getenv('SMTP_PORT')))
                ->setUsername(getenv('SMTP_USER'))
                ->setPassword(getenv('SMTP_PASSWORD'));

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $message = (new Swift_Message('Wonderful Subject'))
                ->setFrom(['john@doe.com' => 'John Doe'])
                ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
                ->setBody('Hola, teneis un nuevo mensaje de '. $pendingMessage->name.' with email: '.$pendingMessage->email.' wiht message: '.$pendingMessage->message);

            // Send the message
            $result = $mailer->send($message);

            $pendingMessage->send = true;
            $pendingMessage->save();
        }
        
    }
}
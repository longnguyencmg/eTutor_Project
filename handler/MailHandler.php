<?php
/**
 * Created by PhpStorm.
 * User: longnguyen
 * Date: 3/11/14
 * Time: 8:07 PM
 */

    require_once '../lib/swift_required.php';

    if (isset($_POST['title'])) {
        $title = $_POST['title'];
    }
    if (isset($_POST['content'])) {
        $content = $_POST['content'];

    }
    if (isset($_POST['receiver'])) {
        $receiver = $_POST['receiver'];

    }

    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
        ->setUsername('nd307@greenwich.ac.uk')
        ->setPassword('123Hurricane');

    $mailer = Swift_Mailer::newInstance($transport);
    if (strpos($receiver,',') !== false) {
        $mailArray = explode(",", $receiver);
        print_r($mailArray);
        $message = Swift_Message::newInstance($title)
            ->setFrom(array('nd307@greenwich.ac.uk'))
            ->setTo($mailArray)
            ->setBody($content);
    }else{
        $message = Swift_Message::newInstance($title)
            ->setFrom(array('nd307@greenwich.ac.uk'))
            ->setTo(array($receiver))
            ->setBody($content);
    }


    //$attachment = Swift_Attachment::newInstance(file_get_contents('path/logo.png'), 'logo.png');
    //$message->attach($attachment);

    $numSent = $mailer->send($message);
    printf("Sent %d messages to %s\n", $numSent, $receiver);

?>
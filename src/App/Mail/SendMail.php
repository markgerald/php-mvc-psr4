<?php

namespace App\Mail;

/**
 * Class SendMail - SwiftMailer
 * @package App\Mail
 */
class SendMail
{
    /**
     * @return array
     */
    public function configuraSwift()
    {
        $transport = \Swift_SmtpTransport::newInstance();
        $mailer = \Swift_Mailer::newInstance($transport);
        $transport->setHost(getenv('SWIFTMAILER_HOST'))
            ->setPort(getenv('SWIFTMAILER_PORT'))//Configurar Porta
            ->setUsername(getenv('SWIFTMAILER_USERNAME'))
            ->setPassword(getenv('SWIFTMAILER_PASSWORD'))
            ->setAuthMode('login');
        $message = \Swift_Message::newInstance($transport);

        return array(
            'mailerInstance' => $mailer,
            'messageInstance' => $message
        );
    }

    /**
     * @param $message
     * @param $mailer
     * @param $assunto
     * @param $destinatario
     * @param $mensagemHtml
     * @param array $dados
     * @return mixed
     */
    public function enviaHtml($message, $mailer, $assunto, $destinatario, $mensagemHtml, array $dados)
    {
        $message->setSubject($assunto)
            ->setFrom(
                array(
                    $dados['email'] => $dados['nome']
                )
            )
            ->setTo(
                array(
                    $destinatario
                )
            )
            ->setBody($mensagemHtml,"text/html");

        return $mailer->send($message);
    }
}

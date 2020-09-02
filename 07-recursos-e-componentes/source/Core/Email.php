<?php


namespace Source\Core;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as MailException;

/**
 * Class Email
 * @package Source\Core
 */
class Email
{
    /** @var array */
    private $data;

    /** @var PHPMailer */
    private $mail;

    /** @var Message */
    private $message;

    /**
     * Email constructor.
     */
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->message = new Message();

        //CONFIG
        $this->mail->isSMTP();
        $this->mail->setLanguage(CONF_MAIL_OPTION_LANG);
        $this->mail->isHTML(CONF_MAIL_OPTION_HTML);
        $this->mail->SMTPAuth = CONF_MAIL_OPTION_AUTH;
        $this->mail->SMTPSecure = CONF_MAIL_OPTION_SECURE;
        $this->mail->CharSet = CONF_MAIL_OPTION_CHARSET;

        //AUTH
        $this->mail->Host = CONF_MAIL_HOST;
        $this->mail->Username = CONF_MAIL_USER;
        $this->mail->Password = CONF_MAIL_PASS;
        $this->mail->Port = CONF_MAIL_PORT;
    }

    /**
     * @param string $subject
     * @param string $message
     * @param string $toEmail
     * @param string $name
     * @return Email
     */
    public function bootstrap(string $subject, string $message, string $toEmail, string $name): Email
    {
        $this->data = new \stdClass();
        $this->data->subject = $subject;
        $this->data->message = $message;
        $this->data->toEmail = $toEmail;
        $this->data->toName = $name;
        return $this;
    }

    public function attach(string $filePath, string $fileName): Email
    {
        $this->data->attach[$filePath] = $fileName;
        return $this;
    }

    /**
     * @param mixed|string $fromEmail
     * @param mixed|string $fromName
     * @return bool
     */
    public function send($fromEmail = CONF_MAIL_SENDER['address'], $fromName = CONF_MAIL_SENDER['name']): bool
    {
        if (empty($this->data)) {
            $this->message->error("Erro ao enviar, favor verificar os dados");
            return false;
        }

        if (!is_email($this->data->toEmail)) {
            $this->message->warning("O e-mail do destinatário não é válido");
            return false;
        }

        if (!is_email($fromEmail)) {
            $this->message->warning("O e-mail do remetente não é válido");
            return false;
        }

        try {

            //MAIL
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->message);
            $this->mail->setFrom($fromEmail, $fromName);

            //SEND
            $this->mail->addAddress($this->data->toEmail, $this->data->toName);

            if (!empty($this->data->attach)) {
                foreach ($this->data->attach as $path => $name) {
                    $this->mail->addAttachment($path, $name);
                }
            }

            $this->mail->send();
            return true;

        } catch (MailException $exception) {
            $this->message->error($exception->getMessage());
            return false;
        }

    }

    /**
     * @return PHPMailer
     */
    public function mail(): PHPMailer
    {
        return $this->mail;
    }

    /**
     * @return Message
     */
    public function message(): Message
    {
        return $this->message;
    }
}
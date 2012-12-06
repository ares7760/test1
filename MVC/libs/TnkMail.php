<?php
require_once('Mail.php');

class TnkMail {

    public $sender;
    public $to;
    public $subject;
    public $message;

    private $base_encoding;
    private $mail_encoding;

    function __construct($base, $mail = 'ISO-2022-JP') {
        $this->base_encoding = $base;
        $this->mail_encoding = $mail;
    }

    function send() {
        echo "----------------";
        $subject = mb_convert_kana($this->subject, "K", $this->base_encoding);
        $subject = mb_encode_mimeheader(mb_convert_encoding($subject, $this->mail_encoding, $this->base_encoding), $this->mail_encoding);
        $message = mb_convert_kana($this->message, "K", $this->base_encoding);
        $body = mb_convert_encoding($message, $this->mail_encoding, $this->base_encoding);
        $message  = "$body\r\n";

        // FIXED PARAMS FOR GOOGLE APPS
        $params = array();
        $params['host'] = 'tls://smtp.gmail.com';
        $params['port'] = 465;
        $params['auth'] = true;
        $params['debug'] = false;
        $params['username'] = 'auto@tnkjapan.com';
        $params['password'] = '216detham';

        $headers = array ();
        $headers['To'] = $this->to;
        $headers['From'] = $this->sender;
        $headers['Reply-To'] = $this->sender;
        $headers['Subject'] = $subject;
        $headers['MIME-Version'] = "1.0";
        $headers['X-Mailer'] = "TnkMail";
        $headers['Content-Type'] = "text/plain; charset=\"ISO-2022-JP\"";
        $smtp = Mail::factory('smtp', $params);
        try {
            $result = $smtp->send($this->to, $headers, $message);
        if ($result) {
            echo 'OK';
        } else {
            echo 'NG' . $result;
        }
        }catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
}

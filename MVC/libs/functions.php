<?php
function sendmail($from, $to, $subject, $message ){
        echo "aaaa";
        $tmail = new TnkMail(BASE_ENCODING);
        $tmail->to = $to;
        $tmail->sender = $from;
        $tmail->subject = $subject;
        $tmail->message = $message;
        $tmail->send();
}

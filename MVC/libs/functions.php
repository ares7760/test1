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

function page_not_found() {
    header("Status: 404 Not Found");
    require_once(TEMPLATE_DIR . '404.html.php');
    exit();
}

function is_post() {
  return isset($_POST);
}

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

function createCityChecks($cities, $checkedarr) {
    $html = array();
    $i = 0;
    foreach ($cities as $key => $val) {
        $i++;
        $rtn = ($i == 5) ? "<br />" : "";
        if ($key !== null)
            $html[] = "<input id='city_{$val['city_id']}' name='city[{$val['city_id']}]' type='checkbox' val='{$val['city_id']}'";
        if (in_array($val['city_id'], $checkedarr)) {
           $html[] =" checked ";
        }
            $html[] ="/><label for='city_{$val['city_id']}'>{$val['city_name']}</label>{$rtn}";
    }
    return implode("\n", $html);
}

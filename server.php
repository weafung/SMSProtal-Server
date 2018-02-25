<?php

require "db.php";

if(!isset($_SERVER['HTTP_X_SMSPROTAL_TOKEN'])) {
    echo "Forbidden";
    exit;
} else {
    $token = $_SERVER['HTTP_X_SMSPROTAL_TOKEN'];
}

$data = file_get_contents("php://input");
$sms = json_decode($data, JSON_UNESCAPED_UNICODE);

if ($sms != null && array_key_exists('number', $sms) 
    && array_key_exists('content', $sms) 
    && array_key_exists('datetime', $sms)) {
        $sql = "INSERT INTO sms_message(token, number, content, datetime, time) VALUES(:token, :number, :content, :datetime, :time)";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
            'token' => $token,
            'number' => $sms['number'],
            'content' => $sms['content'],
            'datetime' => $sms['datetime'],
            'time' => date("Y-m-d H:i:s"),
            ));
        echo 0;
        exit;
}

echo 2;
<?php

header("Content-type: text/html; charset=utf-8");

require "db.php";

$token = trim($_GET['token']);

if ($token == '') {
    echo '403';
    exit;
}

$sql = "SELECT * FROM sms_message WHERE token=:token ORDER BY mid desc LIMIT 15";
$stmt = $db->prepare($sql);
$stmt->execute(array('token' => $token));
if ($stmt->rowCount() <= 0) {
    echo '暂无短信记录';
    exit;
}
foreach ($stmt as $row) {
    echo "发送人:" . $row["number"] . "<br/>";
    echo "短信内容:" . $row["content"] . "<br/>";
    echo "发送时间:" . $row["datetime"] . "<br/>";
    echo "<hr />";
}
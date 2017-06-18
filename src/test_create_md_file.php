<?php

$str = "#### put /apiManagerWebsite/src/test_create_md_file.php\r\n";
$str = $str."接收参数\r\n";
$str = $str."-username `string` => 该用户的名称\r\n";
$str = $str."-password `string` => 密码\r\n";

file_put_contents("../md_file/title.md",$str);

echo $str;


?>
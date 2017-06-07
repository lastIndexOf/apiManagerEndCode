<?php
$request = $_SERVER['REQUEST_METHOD'];
parse_str(file_get_contents('php://input'), $data);
$data = array_merge($_GET, $_POST, $data);
?>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
operate_file();

function operate_file(){
	session_start();
	include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';
	switch ($request) {
		case 'GET':
			doget($data);
			break;

		
		default:
			# code...
			break;
	}

}

function deget($data){
	$docsid = $_GET['docsid'];
	$mysqlpdo_api = new MySqlPDO();

	$select_api = "select count(*) from `api` where `docsid` = ?";
	$myarray_api = array($docsid);

	$mysqlpdo_api->prepare($select_api);

	if () {
		# code...
	}

}







?>
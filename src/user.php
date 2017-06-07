<?php


user_operate();

function user_operate(){
	include($_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/tools/conn.php');
	include($_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php');

	$result = array();
	if ($request=='POST') {

		$datareturn['result'] = 1;
		$username = $data['username'];
		$password = $data['password'];
		$email = $data['email'];
		$phone = $data['phone'];
		$regist_time = date('Y-m-d H:i:s');
		$query_sql = "select count(*) as count from user where `username` = '".$username."'";
		$result = mysql_fetch_array(mysql_query($query_sql));
		$resultCount = $result['count'];
		if ($resultCount>0) {
			$datareturn['result'] = 0;
			$datareturn['msg']='已有此用户名';
		}else{
			$sql = "insert into user (`username`,`password`,`email`,`phone`,`regist_time`) values ('"
			.$username."','"
			.$password."','"
			.$email."','"
			.$phone."','"
			.$regist_time."')";
			mysql_query($sql);
			$newid=mysql_insert_id();
			session_start();
			$_SESSION['uid'] = $newid;
			$datareturn['result'] = 1;
		}
		$result = $datareturn;

	}else if ($request == 'GET') {
		$username = $data['username'];
		$password = $data['password'];
		$select_username_count = "select * from `user` where `username`='".$username."'";
		$query_u = mysql_query($select_username_count);
		$query_username_count = mysql_num_rows($query_u);


		$select_password_count = "select * from `user` where `username`='".$username."' and `password` = '".$password."'";
		$query_p = mysql_query($select_password_count);
		$query_password_count = mysql_num_rows($query_p);
		if ($query_username_count==1) {
			if ($query_password_count==1) {
				$datareturn['result']=1;
			}else{
				$datareturn['result']=0;
				$datareturn['msg']="密码错误";
			}
		}else{
			$datareturn['result']=0;
			$datareturn['msg']="用户名错误";
		}
		$result = $datareturn;


	}

	echo json_encode($result);
}


?>
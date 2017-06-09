<?php


include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/request.php';

user_operate();

function user_operate() {

	$result = array();
	session_start();
	if(isset($_GET["type"]) && !empty($_GET['type']) ) {
		if ($_GET["type"]=='6') {//注册
			$datareturn = array();
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$phone = $_POST['phone'];
			$regist_time = date('Y-m-d H:i:s');
			$avatar = "/apiManagerEndCode/imgs/avatar/default.jpg";
			$mypdo=new MySqlPDO();

			$query_username = "select count(*) as num from user where `username`=?";
			$mypdo->prepare($query_username);
			$myarrayusername = array($username);
			if ($mypdo->executeArr($myarrayusername)) {
				$result_username = $mypdo->fetch();
				$result_user_num = $result_username['num'];
				if ($result_user_num==0) {//没有这个用户名
					$query_phone = "select count(*) as num from user where `phone`=?";
					$mypdo->prepare($query_phone);
					$myarrayphone = array($phone);
					if ($mypdo->executeArr($myarrayphone)) {
						$result_phone = $mypdo->fetch();
						$result_phone_num = $result_phone['num'];
						if ($result_phone_num==0) {//这个手机号码没有被注册
							$query_email = "select count(*) as num from `user` where `email` = ?";
							$mypdo->prepare($query_email);
							$myarrayemail= array($email);
							if ($mypdo->executeArr($myarrayemail)) {
								$result_email = $mypdo->fetch();
								$result_email_num = $result_email['num'];
								if ($result_email_num==0) {//这个邮箱没被注册过
									$_insert = "insert into user (`username`,`phone`,`password`,`email`,`regist_time`,`avatar`,`name`,`job`)values(?,?,?,?,?,?,null,null)";
									$mypdo->prepare($_insert);
									$myarray_insert = array($username,
															$phone,
															$password,
															$email,
															$regist_time,
															$avatar
															);
									$mypdo->executeArr($myarray_insert);
									$datareturn['result']=1;
								}else{//邮箱存在
									$datareturn['result']=0;
									$datareturn['msg']="邮箱已经被注册";
								}
							}
						}else{//手机号因存在
							$datareturn['result']=0;
							$datareturn['msg']="手机已经被注册";
						}
					}

				}else{//用户名已存在
					$datareturn['result']=0;
					$datareturn['msg']="用户名已经被注册";
				}
			}

			$result = $datareturn;


			echo json_encode($result);
		}else if ($_GET["type"] == '1'){//登录
			$username = $_POST['username'];
			$password = $_POST['password'];

			$type = $_POST['type'];
			$datatemp['result'] = 0;
			$mypdo = new MySqlPDO();
			if ($type==0) {//用户名

				$query_user = "select count(*) as num from user where username= ? and password = ?";
				$mypdo->prepare($query_user);
				$myarray = array($username,$password);
				if ($mypdo->executeArr($myarray) ){
					$result_user = $mypdo->fetch();
					$result_user_num = $result_user['num'];
					if ($result_user_num>0) {

						$query = "select * from user where username=? and password=?";
						$mypdo->prepare($query);
						$myarray = array($username,$password);
						if ($mypdo->executeArr($myarray) ){
							$result_u = $mypdo->fetch();
							$datatemp['result'] = 1;
							foreach ($result_u as $key => $value) {
								$datatemp['user'][$key] = $value;
							}
							$_SESSION["id"]=$datatemp['user']['id'];
							$_SESSION["username"]=$datatemp['user']['username'];
						}
					}else{
						$datatemp['result'] = 0;
						$datatemp['msg'] = "用户名或者密码错误";
					}
				}
				$result = $datatemp;
			}else if ($type==1) {//手机号码
				$query_user = "select count(*) as num from user where phone= ? and password = ?";
				$mypdo->prepare($query_user);
				$myarray = array($username,$password);
				if ($mypdo->executeArr($myarray) ){
					$result_user = $mypdo->fetch();
					$result_user_num = $result_user['num'];
					if ($result_user_num>0) {
						$query = "select * from user where phone=? and password=?";
						$mypdo->prepare($query);
						$myarray = array($username,$password);
						if ($mypdo->executeArr($myarray)) {
							$result_u = $mypdo->fetch();
							$datatemp['result'] = 1;
							foreach ($result_u as $key => $value) {
								$datatemp['user'][$key] = $value;
							}
							$_SESSION["id"]=$datatemp['user']['id'];
							$_SESSION["username"]=$datatemp['user']['username'];
						}
					}else{
						$datatemp['result'] = 0;
						$datatemp['msg'] = "手机号码或者密码错误";
					}
				}
				$result = $datatemp;
			}else if ($type==2) {//邮箱号码
				$query_user = "select count(*) as num from user where email= ? and password = ?";
				$mypdo->prepare($query_user);
				$myarray = array($username,$password);
				if ($mypdo->executeArr($myarray) ){
					$result_user = $mypdo->fetch();
					$result_user_num = $result_user['num'];
					if ($result_user_num>0) {
						$query = "select * from user where email=? and password=?";
						$mypdo->prepare($query);
						$myarray = array($username,$password);
						if ($mypdo->executeArr($myarray) ){
							$result_u = $mypdo->fetch();
							$datatemp['result'] = 1;
							foreach ($result_u as $key => $value) {
								$datatemp['user'][$key] = $value;
							}
							$_SESSION["id"]=$datatemp['user']['id'];
							$_SESSION["username"]=$datatemp['user']['username'];
						}
					}else{
						$datatemp['result'] = 0;
						$datatemp['msg'] = "邮箱或者密码错误";
					}
				}
				$result = $datatemp;
			}


			echo json_encode($result);
		}else if ($_GET['type']== '2') {//修改信息
			$update = "update user set username=?,password=?,email=?,phone=?,
			job=?,name=? where id = ?";
			$mypdo = new MySqlPDO();
			$mypdo->prepare($update);
			$myarray = array($_POST['username'],
							$_POST['password'],
							$_POST['email'],
							$_POST['phone'],
							$_POST['job'],
							$_POST['name'],
							$_SESSION['id']);
			if ($mypdo->executeArr($myarray)) {
				$datetemp['result']='1';
			}else{
				$datetemp['result']='0';
				$datetemp['msg']='更新失败';
			}
			$result = $datetemp;
			echo json_encode($result);
		}else if ($_GET['type']=='3') {//登出
			$result = array();
			if (isset($_SESSION["id"]) && isset($_SESSION["username"])) {
				unset($_SESSION["id"]);
				unset($_SESSION["username"]);
				$result['result']=1;
			}else{
				$result['result']=0;
				$result['msg']='您还未登录或者登陆身份过期';
			}
			
			echo json_encode($result);
		}else if ($_GET['type']=='4') {//根据id获取全部信息
			$id =$_POST['id'];
			$result = array();
			$result['result']='0';


			if ($id == $_SESSION['id']) {
				$query_user="select * from user where id = ?";
				$mypdo = new MySqlPDO();
				$mypdo->prepare($query_user);
				$myarray = array($id);
				if ($mypdo->executeArr($myarray)) {
					$result_u = $mypdo->fetch();
					$result['result']='1';
					foreach ($result_u as $key => $value) {
						$result['user'][$key] = $value;
					}
				}else{
					$result['msg']='查询错误';
				}
			}else{
				$result['msg']='尚未登录';
			}


			echo json_encode($result);
		}else if ($_GET['type']=='5') {//上传头像
			$result_temp=array();

			if (isset($_POST['avatar']) && !empty($_POST['avatar']) ) {
				$image_content = $_POST['avatar'];

				if (isset($_SESSION['id']) && !empty($_SESSION['id']) ) {

					$path = "/apiManagerEndCode/imgs/avatar/".$_SESSION['username'].'_'.time();
					if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $image_content, $result_img)){
					  	$type = $result_img[2];
					  	$path =$path.'.'.$type;
					  	if (file_put_contents($_SERVER['DOCUMENT_ROOT'].$path, 
					  		base64_decode(str_replace($result_img[1], '', $image_content)))){
					  	//更新数据库
					  		$update_avatar = "update user set avatar=? where id=?";
					  		$mysqlpdo = new MySqlPDO();
					  		$mysqlpdo->prepare($update_avatar);
					  		$myarray = array($path,$_SESSION['id']);
					  		if ($mysqlpdo->executeArr($myarray)) {
					  			$result_temp['result']=1;

					  		}else{
					  			$result_temp['result']=0;
					  			$result_msg['msg']="数据库更新错误";
					  		}
					  	}else{
					  		$result_temp['result']=0;
					  			$result_msg['msg']="文件保存错误";
					  	}

					}else{
					  		$result_temp['result']=0;
					  			$result_msg['msg']="发送文件格式错误";
					  	}

				}else{
					$result_temp['result']='0';
					$result_temp['msg']='您还未登录或者登陆身份过期';
				}
				
			}else{
				$result_temp['result']='0';
				$result_temp['msg']='请上传头像';
			}
			$result = $result_temp;
			echo json_encode($result);
		}else{
			$result['result']='0';
			$result['msg']='登录身份不对';

			echo json_encode($result);
		}

	}
}
?>
<?php
include $_SERVER['DOCUMENT_ROOT'].'/apiManagerEndCode/src/MySqlPDO.class.php';
docs();

function docs(){
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


function doget($data){
	if ( isset($data['api_id']) && !empty($data['api_id']) ) {
		$api_id = $data['api_id'];
		$mysqlpdo = new MySqlPDO();
		//获取requests
		$select_request = "select * from `api_info` where `api_id` = ?";
		$myarray = array( $api_id );
		$mysqlpdo->prepare($select_request);
		if ($mysqlpdo->executeArr($myarray)) {
			$result['requests'] = array();
			while($rs = $mysqlpdo->fetch()){
				$temp = array();
				foreach ($rs as $key => $value) {
					$temp[$key]=$value;
				}
				$result['requests'][]=$temp;
			}
		}else{
			$result['result']=0;
			$result['msg']="获取请求错误";
			echo json_encode($result);
			return ;
		}

		$select_reqeust_heads = "select * from `request_head` where `api_id`=?";
		$mysqlpdo->prepare($select_reqeust_heads);
		if ($mysqlpdo->executeArr($myarray)) {
			$result['request_heads'] = array();
			while($rs = $mysqlpdo->fetch()){
				$temp = array();
				foreach ($rs as $key => $value) {
					$temp[$key]=$value;
				}
				$result['request_heads'][]=$temp;
			}
		}else{
			$result['result']=0;
			$result['msg']="获取请求头错误";
			echo json_encode($result);
			return ;
		}


		$select_responses = "select * from `response_api` where `api_id`=?";
		$mysqlpdo->prepare($select_responses);
		if ($mysqlpdo->executeArr($myarray)) {
			$result['responses'] = array();
			while($rs = $mysqlpdo->fetch()){
				$temp = array();
				foreach ($rs as $key => $value) {
					$temp[$key]=$value;
				}
				$result['responses'][]=$temp;
			}
		}else{
			$result['result']=0;
			$result['msg']="获取相应参数错误";
			echo json_encode($result);
			return ;
		}

		$result['result']=1;
		echo json_encode($result);



	}
}


?>
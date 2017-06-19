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

function doget($data){

	$str = "api文档\r\n";
	$docsid = $_GET['docsid'];
	$mysqlpdo_docs = new MySqlPDO();

	$select_docs = "select count(*) as num from `docs` where `id` = ?";
	$myarray_docsid = array($docsid);

	$mysqlpdo_docs->prepare($select_docs);

	if ($mysqlpdo_docs->executeArr( $myarray_docsid )) {
		$rs_docsnum = $mysqlpdo_docs->fetch();
		if ($rs_docsnum['num'] >0 ) {
			$select_docs = "select * from `docs` where `id` = ?";
			$mysqlpdo_docs->prepare($select_docs);
			if ($mysqlpdo_docs->executeArr( $myarray_docsid )) {
				$rs = $mysqlpdo_docs->fetch();
				$docs_title = $rs['title'];
				$docs_desc = $rs['desc'];
				$str.="-$docs_desc";
				$str.="\r\n---------------------------------------------------\r\n";

				$select_api = "select count(*) as num from `api` where `docsid`=?";
				$mysqlpdo_apis = new MySqlPDO();
				$mysqlpdo_apis->prepare($select_api);
				if ($mysqlpdo_apis->executeArr($myarray_docsid ) ) {
					$rs_api_num = $mysqlpdo_apis->fetch();

					if ( $rs_api_num['num']>0 ) {
						$select_api = "select * from `api` where `docsid`=?";
						$mysqlpdo_apis->prepare($select_api);
						if ($mysqlpdo_apis->executeArr( $myarray_docsid ) ) {
							while($rs_api = $mysqlpdo_apis->fetch() ){
								$str.="#### ";
								$str.=$rs_api['type']."   ";
								$str.=$rs_api['url']."   ";
								$str.=$rs_api['desc']."   \r\n";

								$str.="接收参数   \r\n";
								$array_api_info_id = array($rs_api['id']);
								$mysqlpdo_info = new MySqlPDO();


								$select_api_info = "select count(*) as num from `api_info` where api_id = ?";
								$mysqlpdo_info->prepare( $select_api_info );
								if (!$mysqlpdo_info->executeArr($array_api_info_id)) {
									$result["result"]="0";
									$result['msg']="查询API信息错误";
									echo json_encode($result);
									return;
								}

								$rs_api_info_num = $mysqlpdo_info->fetch();
								if ($rs_api_info_num['num']>0) {
									$select_api_info = "select * from `api_info` where api_id = ?";
									$mysqlpdo_info->prepare( $select_api_info );

									if (!$mysqlpdo_info->executeArr($array_api_info_id)) {
										$result["result"]="0";
										$result['msg']="查询API信息错误";
										echo json_encode($result);
										return;
									}
									while($rs = $mysqlpdo_info->fetch()){
										$str.="- ".$rs['key']." `".$rs['type']."` => ".$rs['desc']."  \r\n";
									}

								}

								$str.="\r\n响应参数\r\n";
								$mysqlpdo_response = new MySqlPDO();
								$select_response = "select count(*) as num from `response_api` where `api_id` = ?";
								$mysqlpdo_response->prepare($select_response);

								if (!$mysqlpdo_response->executeArr($array_api_info_id)) {
									$result["result"]="0";
									$result['msg']="查询响应参数错误";
									echo json_encode($result);
									return;
								}
								$rs_response_num = $mysqlpdo_response->fetch();
								if($rs_response_num['num']>0){
									$select_response = "select * from `response_api` where `api_id` = ?";
									$mysqlpdo_response->prepare($select_response);

									if (!$mysqlpdo_response->executeArr($array_api_info_id)) {
										$result["result"]="0";
										$result['msg']="查询响应参数错误";
										echo json_encode($result);
										return;
									}
									while($rs_response =  $mysqlpdo_response->fetch()){
										$str.="- ".$rs_response['key']." `".$rs_response['type']."` => ".$rs_response['desc']."  \r\n";
									}

								}
								$str.="\r\n";

									

							}
						}



					}
				}



			}else{
				$result["result"]="0";
				$result['msg']="查询文档信息错误";
				echo json_encode($result);
				return;
			}


		}else{
			$result["result"]="0";
			$result['msg']="查找不到这个文档";
			echo json_encode($result);
			return;
		}
	}else{
		$result["result"]="0";
		$result['msg']="查询文档错误";
		echo json_encode($result);
		return;
	}
$title_file = $docs_title."_".time();
$file_path ="/apiManagerEndCode/md_file/".$title_file.".md";
if (file_put_contents($file_path ,$str)>0) {
	$result['result']=1;
	$result['filepath']=$file_path;
}else{
	$result['result']=0;
	$result['msg']="写入文件错误，请检查权限";
}

echo json_encode($result);

}




?>
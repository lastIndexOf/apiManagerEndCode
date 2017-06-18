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
				$str.="---------------------------------------------------"

				$select_api = "select count(*) as num from `api` where `docsid`=?";
				$mysqlpdo_apis = new MySqlPDO();
				$mysqlpdo_apis->prepare($select_api);
				if ($mysqlpdo_apis->executeArr($myarray_docsid ) ) {
					$rs_api_num = $mysqlpdo_apis->fetch();

					if ( $rs_api_num['num']>0 ) {
						$select_api = "select * from `api` where `docsid`=?";
						$mysqlpdo_apis->prepare($select_api);
						if ($mysqlpdo_apis->executeArr( $myarray_docsid ) ) {
							while($rs_api = $mysqlpdo->fetch() ){
								$str.="#### "
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

}







?>
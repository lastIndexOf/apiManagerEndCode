<?php 
class MySqlPDO{
	protected $dns="";
	protected $db=null;
	protected $objStatement=null;
	function __construct(){

		$root=$_SERVER['DOCUMENT_ROOT'];
		$myconfig=parse_ini_file("$root/apiManagerEndCode/config/config.ini",true);
		$this->dns='mysql:host='.$myconfig['MYSQL']['Ip'].';dbname='.$myconfig['MYSQL']['Database'];
		date_default_timezone_set('PRC');//此句用于消除时间差
		try{
			$this->db = new PDO($this->dns, $myconfig['MYSQL']['Username'], $myconfig['MYSQL']['Password']);
			$this->db->query('set names utf8;');
		}catch(PDOException $e){
			echo "数据库连接错误:".$e->getMessage();
		}
		
	}

	function query($sql){
		$this->objStatement=$db->query($sql);
	}

	function fetch(){
		return $this->objStatement->fetch(PDO::FETCH_ASSOC);
	}

	function prepare($sql){
		return $this->objStatement=$this->db->prepare($sql);
	}

	function executeArr($arr){
		if($this->objStatement->execute($arr)){
			return true;
		}else{
			//输出在实际上线后关闭
			print_r($this->objStatement->errorInfo());
			return false;
		}
	}

	function lastInsertId(){
		return $this->db->lastInsertId();
	}

	function errorInfo(){
		return $this->objStatement->errorInfo();
	}
}

?>
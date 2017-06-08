<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>

</body>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
testtype4();
function testpost(){
	$.ajax({
		url:"/apiManagerEndCode/src/user.php?type=0",
		type:"post",
		dataType:"json",
		data:{
			username:"lyh6",
			password:"123123121",
			email:"11343@111.com",
			phone:"178627001611"
		},
		success:function(data){

		},
		error:function(){}
	})
}


function testget(){
	$.ajax({
		url:"/apiManagerEndCode/src/user.php?type=1",
		type:"post",
		dataType:"json",
		data:{
			type:'0',
			username:"lyh",
			password:"123123",
		},
		success:function(data){

		},
		error:function(){}
	})
}


function testtype4(){
	$.ajax({
		url:"/apiManagerEndCode/src/user.php?type=4",
		type:"post",
		dataType:"json",
		data:{
			id:'1'
		},
		success:function(data){

		},
		error:function(){}
	})
}
</script>


</html>
<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>

</body>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
testget();
function testpost(){
	$.ajax({
		url:"/apiManagerEndCode/src/user.php",
		type:"post",
		dataType:"json",
		data:{
			username:"lyh1",
			password:"123123",
			email:"11343@11.com",
			phone:"17862700161"
		},
		success:function(data){

		},
		error:function(){}
	})
}


function testget(){
	$.ajax({
		url:"/apiManagerEndCode/src/user.php",
		type:"get",
		dataType:"json",
		data:{
			username:"lyh2",
			password:"123123",
		},
		success:function(data){

		},
		error:function(){}
	})
}

</script>


</html>
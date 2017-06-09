<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
<button onclick="testget()">login</button>

<button onclick="testtype3()">logout</button>

<button onclick="testpost()">regist</button>
<form>

	<input type="file" name="touxiang" id="touxiang" onchange="testtype5()">
	<button ></button>
	
</form>

</body>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
function testpost(){
	$.ajax({
		url:"/apiManagerEndCode/src/user.php?type=6",
		type:"post",
		dataType:"json",
		data:{
			username:"lyh11111",
			password:"123123121111",
			email:"11343@1111111.com",
			phone:"1786270111101611"
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
function testtype3(){
	$.ajax({
		url:"/apiManagerEndCode/src/user.php?type=3",
		type:"post",
		dataType:"json",
		data:{
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

var base64code;
function testtype5(){
	var self = this;
  	var file = $("#touxiang")[0].files[0];
  	var fileReader = new FileReader();
  	// this.user.User_Picture = window.URL.createObjectURL(file);
  	fileReader.onload = function(){
    	// self.touxiang = fileReader.result;;
    	base64code = this.result;

    	$.ajax({
			url:"/apiManagerEndCode/src/user.php?type=5",
			type:"post",
			dataType:"json",
			data:{
				avatar:base64code
			},
			success:function(data){

			},
			error:function(){}
		})
  	}
  	fileReader.readAsDataURL(file);

  	
}
</script>


</html>
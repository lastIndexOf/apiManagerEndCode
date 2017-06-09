<!DOCTYPE html>
<html>
<head>
	<title>test</title>
</head>
<body>
<button onclick="testget()">login</button>

<button onclick="testtype3()">logout</button>

<button onclick="testpost()">regist</button>

<button onclick="testaddgroup()">增加组员</button>


<button onclick="testupdategroup()">updateGroup</button>

<button onclick="testdeletegroup()">deleteGroup</button>
<form>

	<input type="file" name="touxiang" id="touxiang" onchange="testtype5()">
	<button ></button>
	
</form>

</body>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">

function testdeletegroup(){
	$.ajax({
		url:"/apiManagerEndCode/src/group.php",
		type:"delete",
		dataType:"json",
		data:{
			groupid:"14"
		},
		success:function(data){

		},
		error:function(){}
	})
}

function testupdategroup(){
	$.ajax({
		url:"/apiManagerEndCode/src/group.php",
		type:"update",
		dataType:"json",
		data:{
			id:"1",
			name:"2222"
		},
		success:function(data){

		},
		error:function(){}
	})
}

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


function testaddgroup(){
	$.ajax({
			url:"/apiManagerEndCode/src/group.php",
			type:"post",
			dataType:"json",
			data:{
				ids:"1+2+3+4",
				name:"1111"
			},
			success:function(data){

			},
			error:function(){}
		})
}

</script>


</html>
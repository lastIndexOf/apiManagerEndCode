<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title>test</title>
</head>
<body>
<button onclick="testget()">login</button>

<button onclick="testtype3()">logout</button>

<button onclick="testpost()">regist</button>

<button onclick="testchange()">changeinfo</button>

<button onclick="testaddgroup()">增加组员</button>


<button onclick="testupdategroup()">updateGroup</button>

<button onclick="testdeletegroup()">deleteGroup</button>

<button onclick="testgetgroupById()">testgetgroupById</button>

<button onclick="testgetgroupByName()">testgetgroupByName</button><br><br>

<button onclick="testadddocs()">testadddocs</button>

<button onclick="testquerydocs()">testquery_docs</button>

<button onclick="testupdatedocs()">testupdate_docs</button>
<form>

	<input type="file" name="touxiang" id="touxiang" onchange="testtype5()">
	<button ></button>
	
</form>

</body>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
function testupdatedocs(){
	$.ajax({
		url:"/apiManagerEndCode/src/docs.php",
		type:"put",
		dataType:"json",
		data:{
				docsid:1,
				title:"标题",
				desc:"描述",
				type:"01"
		},
		success:function(data){},
		error:function(){}
	})
}
function testquerydocs(){
	$.ajax({
		url:"/apiManagerEndCode/src/docs.php",
		type:"get",
		dataType:"json",
		data:{
			page:'1',
			pagesize:'6',
			groupid:'6'
		},
		success:function(data){},
		error:function(){}
	})
}

function testadddocs(){
	$.ajax({
		url:"/apiManagerEndCode/src/docs.php",
		type:"post",
		dataType:"json",
		data:{
			type:"00",
			desc:"文档描述",
			title:"文档标题",
			groupid:'2'
		},
		success:function(data){},
		error:function(){}
	})
}

function testgetgroupById(){
	$.ajax({
		url:"/apiManagerEndCode/src/group.php",
		type:"get",
		dataType:"json",
		data:{
			type:1,
			id:1
		},
		success:function(data){},
		error:function(){}
	})
}

function testgetgroupByName(){
	$.ajax({
		url:"/apiManagerEndCode/src/group.php",
		type:"get",
		dataType:"json",
		data:{
			type:2,
			page:1,
			pagesize:2,
			name:'好'
		},
		success:function(data){},
		error:function(){}
	})
}




function testchange(){
	$.ajax({
		url:"/apiManagerEndCode/src/user.php?type=2",
		type:"post",
		dataType:"json",
		data:{
			userid:8,
			username:"#(111)",
			password:"1111",
			email:"13222",
			phone:"178726",
			job:"jinglui",
			name:"li"
		},
		success:function(data){

		},
		error:function(){}
	})

}

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
			username:"11111",
			password:"1111",
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
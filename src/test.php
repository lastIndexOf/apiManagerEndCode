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

<button onclick="testaddapis()">testadd_apis</button>

<button onclick="testupdateapis()">testupdate_apis</button>

<button onclick="testadd_apiinfo()">testadd_apiinfo</button>

<button onclick="testadd_request_head()">testadd_request_head</button>

<button onclick="testdeleteByApiId()">testdeleteByApiId</button>

<button onclick="testdeleteByHeadId()">testdeleteByHeadId</button>

<button onclick="testupdateHead()">testupdateHead</button><br><br>


<button onclick="testgetHeadByAPIIid()">testgetHeadByAPIIid</button>


<button onclick="testgetHeadByHeadIid()">testgetHeadByHeadIid</button>

<button onclick="testgetallGroup()">testgetallGroup</button>

<button onclick="getuserBygroupid()">getuserBygroupid</button>

<button onclick="testaddComment()">testaddComment</button>

<button onclick="testgetComment()">testgetComment</button>
<button onclick="testquery_apis()">testquery_apis</button><br><br>

<button onclick="testquery_api_infos()">testquery_api_infos</button>

<button onclick="testadd_note()">testadd_note</button>


<button onclick="testadd_commit()">testadd_commit</button>


<button onclick="testget_commit()">testget_commit</button>

<button onclick="deleteBydocsid()">deleteBydocsid</button>


<button onclick="test_testaubmit()">test_testaubmit</button>

<form>

	<input type="file" name="touxiang" id="touxiang" onchange="testtype5()">
	
</form>

</body>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
function test_testaubmit(){
	$.ajax({
		url:"/apiManagerEndCode/src/submit_test.php",
		type:"get",
		dataType:"json",
		data:{
			api_id:"1"
		},
		success:function(data){},
		error:function(){}
	})
}


function deleteBydocsid(){
	$.ajax({
		url:"/apiManagerEndCode/src/docs.php",
		type:"DELETE",
		dataType:"json",
		data:{
			type:"2",
			docsid:"1"
		},
		success:function(data){},
		error:function(){}
	})
}


function testget_commit(){
	$.ajax({
		url:"/apiManagerEndCode/src/commit.php",
		type:"get",
		dataType:"json",
		data:{
			docsid:"1",
			page:"1",
			pagesize:"8"
		},
		success:function(data){},
		error:function(){}
	})
}


function testadd_commit(){
	$.ajax({
		url:"/apiManagerEndCode/src/commit.php",
		type:"post",
		dataType:"json",
		data:{
			docsid:"1",
			content:"111111",
			userid:"8",
			preview:"22222"
		},
		success:function(data){},
		error:function(){}
	})
}


function testadd_note(){
	$.ajax({
		url:"/apiManagerEndCode/src/note.php",
		type:"post",
		dataType:"json",
		data:{
			userid:"8",
			content:"111111",
			title:"title",
			m_title:"mtitle",
			preview:"22222"
		},
		success:function(data){},
		error:function(){}
	})
}


function testquery_api_infos(){
	$.ajax({
		url:"/apiManagerEndCode/src/api_info.php",
		type:"GET",
		dataType:"json",
		data:{
			api_id:"1"
		},
		success:function(data){},
		error:function(){}
	})
}


function testquery_apis(){
	$.ajax({
		url:"/apiManagerEndCode/src/apis.php",
		type:"GET",
		dataType:"json",
		data:{
			docsid:"1"
		},
		success:function(data){},
		error:function(){}
	})
}
function testgetComment(){
	$.ajax({
		url:"/apiManagerEndCode/src/comment.php",
		type:"get",
		dataType:"json",
		data:{
			docsid:"1",
			page:"1",
			pagesize:"10"
		},
		success:function(data){},
		error:function(){}
	})
}



function testaddComment(){
	$.ajax({
		url:"/apiManagerEndCode/src/comment.php",
		type:"post",
		dataType:"json",
		data:{
			docsid:"1",
			content:"您好",
			preview:"年后",
			from:"8",
			comment_id:"3"
		},
		success:function(data){},
		error:function(){}
	})
}
function getuserBygroupid(){
	$.ajax({
		url:"/apiManagerEndCode/src/group.php",
		type:"get",
		dataType:"json",
		data:{
			type:"4",
			groupid:'15'
		},
		success:function(data){},
		error:function(){}
	})
}


function testgetallGroup(){
	$.ajax({
		url:"/apiManagerEndCode/src/group.php",
		type:"get",
		dataType:"json",
		data:{
			type:"3",
			page:"1",
			pagesize:'4'
		},
		success:function(data){},
		error:function(){}
	})
}

function testgetHeadByHeadIid(){
	$.ajax({
		url:"/apiManagerEndCode/src/request_head.php",
		type:"get",
		dataType:"json",
		data:{
			type:"2",
			head_id:"7"
		},
		success:function(data){},
		error:function(){}
	})
}



function testgetHeadByAPIIid(){
	$.ajax({
		url:"/apiManagerEndCode/src/request_head.php",
		type:"get",
		dataType:"json",
		data:{
			type:"1",
			api_id:"1"
		},
		success:function(data){},
		error:function(){}
	})
}
function testupdateHead(){
	$.ajax({
		url:"/apiManagerEndCode/src/request_head.php",
		type:"put",
		dataType:"json",
		data:{
			heads:[
				{
					id:"5",
					head:"1111"
				},
				{
					id:"6",
					head:"2222"
				},
				{
					id:"7",
					head:"3333"
				}
			]
		},
		success:function(data){},
		error:function(){}
	})
}


function testdeleteByApiId(){
	$.ajax({
		url:"/apiManagerEndCode/src/request_head.php",
		type:"delete",
		dataType:"json",
		data:{
				type:"1",
				api_id:1
		},
		success:function(data){},
		error:function(){}
	})
}
function testdeleteByHeadId(){
	$.ajax({
		url:"/apiManagerEndCode/src/request_head.php",
		type:"delete",
		dataType:"json",
		data:{
				type:"2",
				head_id:1
		},
		success:function(data){},
		error:function(){}
	})
}


function testadd_request_head(){
	$.ajax({
		url:"/apiManagerEndCode/src/request_head.php",
		type:"post",
		dataType:"json",
		data:{
			heads:[
				{
					head:"head1",
					api_id:"1",
					name:"qqe"
				},
				{
					head:"head2",
					api_id:"1",
					name:"12233"
				}

			]
	
		},
		success:function(data){},
		error:function(){}
	})
	var arr = [
				{
					head:"head1",
					api_id:"1",
					name:"qqe"
				},
				{
					head:"head2",
					api_id:"1",
					name:"12233"
				}

			];
			arr = JSON.stringify(arr);

	console.log(arr);
}



function testadd_apiinfo(){
		$.ajax({
		url:"/apiManagerEndCode/src/api_info.php",
		type:"post",
		dataType:"json",
		data:{
			children:[

				{
					api_id:"1",
					key:"key11",
					desc:"desc11",
					type:"11",
					required:"1",
					children:[
							{
								api_id:"1",
								key:"key22",
								desc:"desc22",
								type:"22",
								required:"2",
								children:[
										{
											api_id:"1",
											key:"key22",
											desc:"desc22",
											type:"22",
											required:"2"
										},
										{
											api_id:"1",
											key:"key22",
											desc:"desc22",
											type:"22",
											required:"2"
										},
									]
								
							}
					]
			
				},
				{
					api_id:"1",
					key:"21",
					desc:"21",
					type:"21",
					required:"1",
					children:[]
			
				},
				{
					api_id:"1",
					key:"21",
					desc:"21",
					type:"21",
					required:"1",
					children:[]
			
				},
				{
					api_id:"1",
					key:"21",
					desc:"21",
					type:"21",
					required:"1",
					children:[]
			
				},
			]
	
		},
		success:function(data){},
		error:function(){}
	})
}


function testupdateapis(){
	$.ajax({
		url:"/apiManagerEndCode/src/apis.php",
		type:"put",
		dataType:"json",
		data:{
				apisid:1,
				url:"/apiManagerEndCode/src/apis.php",
				desc:"描述222",
				type:"put"
		},
		success:function(data){},
		error:function(){}
	})
}








function testaddapis(){
	$.ajax({
		url:"/apiManagerEndCode/src/apis.php",
		type:"post",
		dataType:"json",
		data:{
				docsid:1,
				url:"/apiManagerEndCode/src/apis.php",
				desc:"描述",
				type:"post"
		},
		success:function(data){},
		error:function(){}
	})
}


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
			username:"lyh11111",
			password:"123123121111",
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
				ids:"8",
				name:"1111"
			},
			success:function(data){

			},
			error:function(){}
		})
}

</script>


</html>
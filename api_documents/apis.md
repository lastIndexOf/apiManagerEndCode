#apis
##

### 1. <a name='add'>添加API</a>

	post /apiManagerEndCode/src/apis.php

	request:
	{
		docsid:#(文档id),
		type:#(请求类型),
		url:#(请求路径),
		desc:#(接口描述)
	}

	response:
	{
		result:(0|1)#0 添加失败，#1添加成功
		id:(api的id)
		msg:(失败信息)
	}


###2. <a name='change'>修改API</a>

	put /apiManagerEndCode/src/apis.php

	request:
	{
		apisid:#(api的id),
		type:#(请求方式),
		url:#(请求路劲),
		desc:#(接口描述)
	}
	
	response:
	{
		result:(0|1)#0 修改失败，#1修改成功
		msg:(失败信息)
	}

###3. <a name='del'>删除API</a>

	//同时用删除APIinfo表中的数据
	del /apiManagerEndCode/src/apis.php
	request:
	{
		apisid:#(api的id)
	}
	
	response:
	{
		result:(0|1)#0 删除失败，#1删除成功
		msg:(失败信息)
	}


###4. <a name='query'>查找API</a>

	根据docs的id查找
	get /apiManagerEndCode/src/apis.php
	request:
	{
		docsid:#(docs的id)，
	}
	
	response:
	{
		result:(0|1)0错误 1 成功
		msg:错误信息
		resultList:[
					{
						apisid:#(api的id),
						type:#(请求路径),
						url:#(请求路劲),
						desc:#(接口描述)
						
					},
					{
						apisid:#(api的id),
						type:#(请求路径),
						url:#(请求路劲),
						desc:#(接口描述)
					},
					]
	}

##

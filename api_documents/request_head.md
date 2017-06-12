#request_head

##

1.[增加数据](#addhead)

2.[删除数据](#deleteHead)

3.[更新request_head](#update_request_head)

4.[查找数据](#select_name)

###1. <a name='addhead'>增加请求头</a>

	post /apiManagerEndCode/src/request_head.php
	request:
	{
		heads:[
				{
					head:(请求头),
					api_id:(API的id)
				},
				{
					head:(请求头),
					api_id:(API的id)
				},
	
			]
	}

	response:
	{
		result:(0|1)0表示有错，1表示成功
		msg:(错误信息)
	}


###2. <a name='deleteHead'>删除数据</a>

	delete /apiManagerEndCode/src/request_head.php

	1,根据API_id删除

	request:
	{
		type:1,
		api_id:(api的id)
	}
	
	response:
	{
		result:(0|1)0表示删除失败，1成功
		msg:错误信息
	}

##
	delete /apiManagerEndCode/src/request_head.php

	2, 根据request_head的id删除

	request:
	{
		type:2,
		head_id:(request_head的id)
	}
	
	response:
	{
		result:(0|1)0表示失败，1成功
		msg:错误信息
	}


###3. <a name='update_request_head'>更新</a>


	put /apiManagerEndCode/src/request_head.php
	request:
	{
		heads:[
				{
					id:(更新的id),
					head:(请求头名称)
				},
				{
					id:(更新的id),
					head:(请求头名称)
				},
				{
					id:(更新的id),
					head:(请求头名称)
				}
				]
	}
	
	response:
	{
		result:(0|1)0表示失败，1成功
		msg:错误信息
	}

###4. <a name='select_name'>查找数据</a>

	1.根据API_id 错误，
	get  /apiManagerEndCode/src/request_head.php
	request:
	{
		type:1,
		api_id:(api的id)
	}
	
	response:
	{
		result:(0|1)0表示失败，1成功
		msg:错误信息
		resultList:[
					{
						id:(request_head 的id),
						head:(头部名称)},
						api_id:(API的id)
					},
					{
						id:(request_head 的id),
						head:(头部名称)},
						api_id:(API的id)
					},
					{
						id:(request_head 的id),
						head:(头部名称)},
						api_id:(API的id)
					}
					]
	}
						

##


	2.根据request_head的id查找
	get /apiManagerEndCode/src/request_head.php
	request:
	{
		type:2,
		head_id:(request_head的id)
	}
	
	response:
	{
		result:(0|1)0表示失败，1成功
		msg:错误信息,
		id:(request_head 的id),
		head:(头部名称)},
		api_id:(API的id)
	}
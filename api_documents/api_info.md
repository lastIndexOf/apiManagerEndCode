#api_info
##

1. [增加数据](#addapiinfo)
2. [查看apiinfo](#queryInfo)


###1. <a name='addapiinfo'>增加文档</a>
	post /apiManagerEndCode/src/api_info.php

	request:
	{
		
		children:[

				{
					api_id:
					key:
					desc:
					type:
					required:(0|1) 0表示不是必填，1表示必填,
					children:[
							{
								api_id:
								key:
								desc:
								type:
								required:(0|1) 0表示不是必填，1表示必填,
								children:[
									{
									}
								]
							}
					]
			
				},
				{
					api_id:
					key:
					desc:
					type:
					required:(0|1) 0表示不是必填，1表示必填,
					children:[
							{
								api_id:
								key:
								desc:
								type:
								required:(0|1) 0表示不是必填，1表示必填,
								children:[
									{
									}
								]
							}
					]
			
				}
		]
	}

	response:
	{
		result:(0|1)0表示有错，1表示成功
		msg:(错误信息)
	}


###2. <a name='queryInfo'>查看apiinfo</a>

	request:
	{
		api_id:
	}
	
	response:
	{
		result:(0|1),
		msg:错误信息,
		resultList:[
			{	
				id:
				key:
				desc:
				type:
				rank:
				parent:
				required:
			},
			{
				id:
				key:
				desc:
				type:
				rank:
				parent:
				required:
			},
			{
				id:
				key:
				desc:
				type:
				rank:
				parent:
				required:
			}
		
		
		]
	}
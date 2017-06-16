#测试

##

###1. <a name="getApi">获取api的所有信息</a>

	get /apiManagerEndCode/src/submit_test.php
	request:
	{
		api_id:(api的id)
	}

	response:
	{
		requests:
			[
				{
					id:
					key:
					desc:
					type:
					rank:
					parent:
					api_id:
					required:
				},
				{
					id:
					key:
					desc:
					type:
					rank:
					parent:
					api_id:
					required:
				}
			],
		request_heads:[
				{
					id:
					head:
					api_id:
					name:
				},
				{
					id:
					head:
					api_id:
					name:
				},
			],

		responses:[
				{
					id:
					key:
					desc:
					type:
					rank:
					parent:
					api_id:
					required:
				},
				{
					id:
					key:
					desc:
					type:
					rank:
					parent:
					api_id:
					required:
				}
			]
		
	}


2. <a name='test'>测试开始</a>


	post /apiManagerEndCode/src/submit_test.php
	request:
	{
		api_id:
		根据api_info 的参数来设置
	}

	response:
{
	result:(0|1)
	msg:错误信息
}
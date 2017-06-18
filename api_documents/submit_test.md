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



###2 <a name='outputFile'>导出文件</a>
	
	request:
	{
		docsid:(导出文件的id)
	}
	
	response:
	{
		result:(0|1)
		msg:
		filepath:文件路径
	}
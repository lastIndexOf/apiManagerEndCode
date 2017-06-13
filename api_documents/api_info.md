#api_info
##

1. [增加数据](#addapiinfo)
2. []


###1. <a name='addapiinfo'>增加文档</a>
	post /apiManagerEndCode/src/api_info.php

	request:
	{
		api_id:
		key:
		desc:
		type:
		required:(0|1) 0表示不是必填，1表示必填,
		child:{
			api_id:
			key:
			desc:
			type:
			required:(0|1) 0表示不是必填，1表示必填,
			child:{
			
			}
		}
	
	}

	response:
	{
		result:(0|1)0表示有错，1表示成功
		msg:(错误信息)
	}

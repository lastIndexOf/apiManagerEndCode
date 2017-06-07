#group_user
##

###1. add [增加分组](#add)
###2. del [根据group删除分组](#del)
##


###1. <a name='add'>增加分组</a>

	post /apiManagerEndCode/src/usergroup.php
	request:
	{
		userid:#(user 的id),
		groupid:#(group的id)
	}

	response:
	{
		result:(0|1)0# 增加失败，1#增加成功
		msg:#(失败信息)
	}


###2. <a name='del'>根据group删除分组</a>

	DELETE /apiManagerEndCode/src/usergroup.php
	request
	{
		userid:#(user的id)
	}
	
	response
	{
		result:(0|1)0# 删除失败，1#删除成功
		msg:#(失败信息)
	}
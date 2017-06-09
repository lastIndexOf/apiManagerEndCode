#docs
##


###1. add [增加文档](#add)
###2. del [删除文档](#del)
###3. query [查看文档标题](#query)
###4.  change [修改文档标题](#change)
##


###1. <a name='add'>增加文档</a>

	post /apiManagerEndCode/src/docs.php
	request:
	{
		type:#(文档类型)
		desc:#(文档描述)
		title:#(文档标题),
		groupid:#(所属的组id)
	}
	
	response：
	{
		result:(0|1)#0增加失败， #1增加成功
		msg:#(失败信息)
	}

	type---->00单人，web
			10多人，web

###2. <a name='del'>删除文档</a>

	delete /apiManagerEndCode/src/docs.php
	request:
	{
		groupid:#(组的id，只能根据组删除)
	}
	response:
	{
		result:(0|1)#0删除失败， #1删除成功
		msg:#(失败信息)
	}


###3. <a name='query'>查看文档标题</a>

	get /apiManagerEndCode/src/docs.php
	//查看文档细节在APIs.md中
	request:
	{
		groupid:#(group 的id)，
	}
	response:
	{
		resultList:[{
						docsid:#(文档id),
						publish_time:#(发布时间),
						title:#(文档标题)
					},
					{
						docsid:#(文档id),
						publish_time:#(发布时间),
						title:#(文档标题)
					}]
	}

###4. <a name='change'>修改文档标题</a>
	
	put /apiManagerEndCode/src/docs.php
	
	request:
	{
		docsid:#(文档id)，
		title:#(标题)
	}
	response：
	{
		result:(0|1)#0修改失败， #1修改成功
		msg:#(失败信息)
	}
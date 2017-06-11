#docs
##


1. [增加文档](#add)
2. [按组删除文档](#del)
3. [查看文档标题](#query)
4. [修改文档标题](#change)

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
		id:(增加成功返回的id)
	}

	type---->00单人，web
			10多人，web

###2. <a name='del'>删除文档</a>

	//1. 根据组删除文档
	delete /apiManagerEndCode/src/docs.php
	request:
	{
		type:1
		groupid:#(组的id，根据组删除)
	}
	response:
	{
		result:(0|1)#0删除失败， #1删除成功
		msg:#(失败信息)
	}

##

	//2. 根据文档id删除文档
	delete /apiManagerEndCode/src/docs.php
	request:
	{
		type:2
		docsid:#(文档id，根据文档id删除)
	}
	response:
	{
		result:(0|1)#0删除失败， #1删除成功
		msg:#(失败信息)
	}


###3. <a name='query'>查看文档，只能查看这个组的文档</a>

	get /apiManagerEndCode/src/docs.php
	//查看文档细节在APIs.md中
	request:
	{
		page:(页数),
		pagesize:(页的大小),
		groupid:#(group 的id)
	}
	response:
	{
		result:(0|1) 0查询失败， 1查询成功,
		msg:查询失败信息
		total:(总数)
		resultList:[{
						id:#(文档id),
						public_time:#(发布时间),
						title:#(文档标题),
						desc:(描述),
						type:(类型)
					},
					{
						id:#(文档id),
						public_time:#(发布时间),
						title:#(文档标题)
						desc:(描述),
						type:(类型)
					}]
	}

###4. <a name='change'>修改文档信息</a>
	
	put /apiManagerEndCode/src/docs.php
	
	request:
	{
		docsid:#(文档id),
		title:#(标题),
		desc:(描述),
		type:(类型)
	}
	response：
	{
		result:(0|1)#0修改失败， #1修改成功
		msg:#(失败信息)
	}
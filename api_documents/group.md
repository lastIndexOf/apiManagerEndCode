#group
##

###1. addgroup [创建group](#addgroup)
###2. changegroup [修改group名称](#changegroup)
###3. changegroup [删除一个group](#changegroup)
###4. query [查询group](#query)

##

### <a name='addgroup'>1. 创建group</a>

	post /apiManagerEndCode/src/group.php
	request:
	{
		ids:1+2+3,
		name:#(组名称)
	}

	response:
	{
		result:(0|1)#0 创建失败，#1创建成功
		msg:#(返回错误信息)
		id:#(group id)
	}



### <a name='changegroup'>2. 修改group名称</a>

	update /apiManagerEndCode/src/group.php
	request:
	{
		id:#(group表的id),
		name:#(修改后的组名称)
	}

	response:
	{
		result:(0|1)#0 修改失败，#1 修改成功
		msg:#(失败信息) 
	}


### <a name='changegroup'>3. 删除一个group</a>

	delete /apiManagerEndCode/src/group.php
	request:
	{
		groupid:#(group id)
	}

	response:
	{
		result:(0|1)#0 删除失败，#1 删除成功
		msg:#(失败信息)
	}

	要执行的操作：比较同意解除group的人数是否占总体人数的一半，然后再执行删除，
				删除的同时，要删除这个group的docs和聊天记录



### <a name='query'>4. 查询group</a>


	1. 根据id 查询组名称
	get /apiManagerEndCode/src/group.php
	request:
	{
		type:1
		id:#(group id)
	}
	response:
	{
		result:(0|1)0失败 1成功,
		msg:失败信息
		group:{
				name:(name),
				headman:(headman),
				id:groupid
			}
	}


##

	2. 根据输入名称 相似查找其他组
	get /apiManagerEndCode/src/group.php
	request:
	{
		type:2
		page:(页数),
		pagesize:(页大小),
		name:#(输入名称)
	}
	response：
	{	
		result:(0|1)0 查找失败，1查找成功
		msg:(错误信息)
		total:总数
		resultList:[
						{
							id:#(group id),
							name:#(group name),
							headman:#(组长)
						},
						{
							id:#(group id),
							name:#(group name),
							headman:#(组长)
					   	}
				  ]
	}

##
	3. 根据用户id组
	get /apiManagerEndCode/src/group.php
	request:
	{
		type:3
		page:(页数),
		pagesize:(页大小),
	}
	response：
	{	
		result:(0|1)0 查找失败，1查找成功
		msg:(错误信息)
		total:总数
		resultList:[
						{
							id:#(group id),
							name:#(group name),
							headman:#(组长)
						},
						{
							id:#(group id),
							name:#(group name),
							headman:#(组长)
					   	}
				  ]
	}

	4. 根据groupid获取该组全部组员

	get /apiManagerEndCode/src/group.php
	request:
	{
		type:4
		groupid:
	}
	response：
	{	
		result:(0|1)0 查找失败，1查找成功
		msg:(错误信息)
		resultList:[
						{
							id:#(user id),
							name:#(user name),
							username:
							job:
							avatar:
							phone:
							email:
						},
						{
							id:#(user id),
							name:#(user name),
							username:
							job:
							avatar:
							phone:
							email:
					   	}
				  ]
	}


	5. 根据 输入 查找用户
	request:
	{
		type:5,
		name:()
	}
	request:
	{
		result:(0|1)
		msg:
		resultList:[
			{
				name:
				id:
			},
			{
				name:
				id:
			}
		]
	}
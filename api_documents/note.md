# node

##

### 1. <a name='add'>增加备忘录</a>

	post /apiManagerEndCode/src/note.php
	request:
	{
		userid:#(用户id)
		content:#(备忘录内容)
		title:#(标题)
		m_title:#(小标题)
		preview:(预览)
	}
	
	response：
	{
		result:#(0|1)#0 增加失败 #1 增加成功
		msg:#(失败信息)，
		id:（增加的id）
	}


### 2. <a name='change'>修改备忘录</a>#每次修改都要修改时间
	
	put /apiManagerEndCode/src/note.php
	request:
	{
		id:(备忘录id),
		content:#(备忘录内容),
		title:#(标题),
		m_title:#(小标题),
		preview:
	}
	
	response:
	{
		result:#(0|1)#0 修改失败 #1 修改成功
		msg:#(失败信息)
	}


### 3. <a name='del'>删除备忘录</a>
	

	delete /apiManagerEndCode/src/note.php
	1. 根据备忘录id删除记录
	request:
	{
		type:1
		id:(备忘录id)
	}
	
	response:
	{
		result:#(0|1)#0 删除失败 #1 删除成功
		msg:#(失败信息)
	}


### 4. <a name='querybyid'>根据id查询</a>

	get /apiManagerEndCode/src/note.php
	request:
	{
		type:1,
		id:#(备忘录id)
	}
	
	response:
	{
		result:(0|1)#0查询失败 #1 查询成功
		msg:#(失败信息)
		note:{
			id:#(备忘录id),
			content:(内容),
			title:(标题),
			m_title:(小标题),
			time:(备忘录创建时间或最后一次修改时间)
			preview:
		}
	}

### 5. <a name='like_title'>根据标题相似查找</a>


	fwr /apiManagerEndCode/src/note.php
	request:
	{
		type:2,
		title:(标题),
		page:#(第几页),
		pagesize:#(每一页的页数)
	}
	
	response:
	{
		result:(0|1)#0查询失败 #1 查询成功
		msg:#(失败信息),
		total:#(总条数)
		notes:[{
					id:#(备忘录id),
					content:(内容),
					title:(标题),
					m_title:(小标题),
					time:(备忘录创建时间或最后一次修改时间)
					preview:
				},
				{
					id:#(备忘录id),
					content:(内容),
					title:(标题),
					m_title:(小标题),
					time:(备忘录创建时间或最后一次修改时间)
					preview:
				},...]
	}

### 6. <a name='like_m_title'>根据小标题相似查找</a>

	request:
	{
		type:3,
		m_title:(),
		page:(),
		pagesize:(),
	}
	
	response:
		result:(0|1)#0查询失败 #1 查询成功
		msg:#(失败信息),
		total:(),
		notes:
			[{
				id:#(备忘录id),
				content:(内容),
				title:(标题),
				mtitle:(小标题),
				time:(备忘录创建时间或最后一次修改时间)
				preview:
			},
			{
				id:#(备忘录id),
				content:(内容),
				title:(标题),
				mtitle:(小标题),
				time:(备忘录创建时间或最后一次修改时间)
				preview:
			},...]
	}

### 6. <a name='querybycontent'>根据内容相似查找</a>
	
	request:
	{
		type:4,
		content:#(),
		page:(),
		pagesize:()
	}
	
	response:
	{
		result:(0|1)#0查询失败 #1 查询成功
		msg:#(失败信息),
		total:(),
		notes:[
				{
					id:#(备忘录id),
					content:(内容),
					title:(标题),
					mtitle:(小标题),
					time:(备忘录创建时间或最后一次修改时间)
					preview:
				},
				{
					id:#(备忘录id),
					content:(内容),
					title:(标题),
					mtitle:(小标题),
					time:(备忘录创建时间或最后一次修改时间)
					preview:
				},...]
	}

### 7. 获取列表

	request:
	{
		type:5,
		page:(),
		pagesize:()
	}


	response:
	{
		result:(0|1)#0查询失败 #1 查询成功
		msg:#(失败信息),
		total:(),
		notes:[
				{
					id:#(备忘录id),
					content:(内容),
					title:(标题),
					mtitle:(小标题),
					time:(备忘录创建时间或最后一次修改时间)
					preview:
				},
				{
					id:#(备忘录id),
					content:(内容),
					title:(标题),
					mtitle:(小标题),
					time:(备忘录创建时间或最后一次修改时间)
					preview:
				},...]
	}
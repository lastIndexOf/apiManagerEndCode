#comment
##
###1. [增加评论](#addcomment)
###2. [查看评论](#selectcomment)

##

	
###1. <a name='addcomment'>增加评论</a>

	post  /apiManagerEndCode/src/comment.php
	request:
	{
		docsid:
		content:
		preview:
		from:(评论者)
		comment_id:（被评论的人）（对文档的评论为""）
	}
	
	response:
	{
		result:(0|1)0 失败 1成功
	}


###2. <a name='selectcomment'>查看评论</a>
	

	get /apiManagerEndCode/src/comment.php
	request:
	{
		docsid:"文档的 id",
		page:第几页
		pagesize:页数
	}
	response:
	{
		total:总数
		resultList:[
			{
				id:
				docsid:
				comment_id:
				fromuser:
				content:
				time:
				preview:	
			},
			{
				id:
				docsid:
				comment_id:
				fromuser:
				content:
				time:
				preview:	
			},
			{
				id:
				docsid:
				comment_id:
				fromuser:
				content:
				time:
				preview:	
			},....
		]
	}
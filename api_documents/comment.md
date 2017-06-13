#comment
##
###1. [增加评论](#addcomment)
	
	1.<a name='addcomment'>增加评论</a>
	request:
	{
		docsid:
		content:
		preview:
		from:(评论者)
		to:（被评论的人）（对文档的评论为""）
	}
	
	response:
	{
		result:(0|1)0 失败 1成功
	}
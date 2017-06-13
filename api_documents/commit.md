#commit

##
###1. [增加提交数据信息](#addcommit)


1.<a name='addcommit'>增加提交数据</a>

	post /apiManagerEndCode/src/commit.php
	request:
	{
		docsid:(提交commit的文档id),
		userid:(用户的id),
		content:(内容),
		preview:(预览)
	}
	
	response:
	{
		result:(0|1)0表示失败 1成功
		msg:错误信息
	}



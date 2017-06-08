#user
##

###1. regist [注册](#regsit)
###2. login [登录](#login)
###3. changeInfo [修改信息](#changeInfo)
##

### <a name="regist">1.注册用户</a>

    post /apiManagerEndCode/src/user.php?type=0
	request:
	{
		username:#(用户名),
		password:#(密码),
		email:#(邮箱),
		phone:#(手机号码)
	}

	response:
	{
		result:(0|1)#0注册失败，#1注册成功
		msg:#(失败信息)
	}


### <a name="login">2.登录</a>

	get /apiManagerEndCode/src/user.php?type=1

	request:
	{
		type:(0|1|2)#0 表示用户名登录，1表示手机号码 2表示邮箱
		login:#(登陆)
		password:#(密码)
	}

	response
	{
		result:(0|1)#0登录失败，#1登录成功
		msg:#(失败信息),
		user:{
			id:"用户id",
			username:"用户名",
			password:"密码",
			phone:"手机",
			email:"邮箱",
			regist_time:"注册时间"		
		}

	}


### <a name="changeInfo">3.修改信息</a>

	post /apiManagerEndCode/src/user.php?type=2
	
	request:
	{
		userid:#(user表中的id),
		username:#(用户名),
		password:#(密码),
		email:#(邮箱),
		phone:#(手机)
		
	}

	response:
	{
		result:#(0|1)#0修改成功，#1修改失败
		msg:#(修改结果)
	}
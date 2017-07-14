<?php
return array(
	//'配置项'=>'配置值'
	/* 数据库设置 */
    'DB_TYPE'               =>  'pdo',          // 数据库类型
    'DB_USER'               =>  'root',         // 用户名
    'DB_PWD'                =>  'JQR123456',             // 密码
    'DB_PORT'               =>  '3306',         // 端口
    'DB_PREFIX'             =>  'tx_',          // 数据库表前缀
    'DB_DSN'                =>  'mysql:host=127.0.0.1;dbname=jqr;charset=UTF8',
    'DB_FIELDTYPE_CHECK'    =>  false,       	// 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,        	// 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      	// 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        =>  0, 				// 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        =>  false,       	// 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         =>  1, 				// 读写分离后 主服务器数量
    'DB_SLAVE_NO'           =>  '', 			// 指定从服务器序号
    'DB_SQL_BUILD_CACHE'    =>  false, 			// 数据库查询的SQL创建缓存
    'DB_SQL_BUILD_QUEUE'    =>  'file',   		// SQL缓存队列的缓存方式 支持 file xcache和apc
    'DB_SQL_BUILD_LENGTH'   =>  20, 			// SQL缓存的队列长度
    'DB_SQL_LOG'            =>  false, 			// SQL执行日志记录
    'DB_BIND_PARAM'         =>  false, 			// 数据库写入数据自动参数绑定

    /* 错误设置 */
    'ERROR_MESSAGE'         =>  '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
    'ERROR_PAGE'            =>  '',	// 错误定向页面
    'SHOW_ERROR_MSG'        =>  false,    // 显示错误信息
    'TRACE_MAX_RECORD'      =>  100,    // 每个级别的错误信息 最大记录数

    /* 日志设置 */
    'LOG_RECORD'            =>  false,   // 默认不记录日志
    'LOG_TYPE'              =>  'File', // 日志记录类型 默认为文件方式
    'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
    'LOG_FILE_SIZE'         =>  2097152,	// 日志文件大小限制
    'LOG_EXCEPTION_RECORD'  =>  false,    // 是否记录异常信息日志
    // 允许访问模块
    'MODULE_ALLOW_LIST'    =>    array('Home','admin','Phone'),
    // 默认模块
    'DEFAULT_MODULE'       =>    'home',  // 默认模块
     // 后台别名映射
    // 'URL_MODULE_MAP'    =>    array('tengxiang'=>'admin'),
     'URL_MODEL'             =>  2,    
	 // 'SHOW_ERROR_MSG'        =>  true, 
	 define('USER_KEY','1c81e47104642fd96303479b58eef8e4'),
define('SYSTEM_ADDRESS','http://search.zztxkj.com/'), 
);
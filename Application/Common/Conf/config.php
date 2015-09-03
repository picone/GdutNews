<?php
return array (
		// 数据库设置
		'DB_TYPE' => 'sqlsrv',
		'DB_DSN' => 'sqlsrv:Server=;database=NewsPublishSystem',
		'DB_USER' => 'gdut',
		'DB_PWD' => '123',
		// ThinkPHP设置
		'MULTI_MODULE' => false,
		'URL_PARAMS_BIND_TYPE' => 1,
		'DEFAULT_FILTER' => 'htmlspecialchars,addslashes',
		// 缓存设置
		'COOKIE_EXPIRE' => 7200,
		// 导航栏缓存时间
		'CACHE_NAVIGATION' => 7200,
		// 首页新闻缓存时间
		'CACHE_INDEX' => 120,
		// 具体分类下新闻列表缓存时间
		'CACHE_CATEGORY' => 120,
		// 搜索结果缓存时间
		'CACHE_SEARCH' => 120,
		// 新闻列表每页数目
		'PASSAGE_LEN' => 30,
		// 游客账户
		'LOGIN_USERNAME' => '',
		'LOGIN_PASSWORD' => '',
		// 算法密钥
		'AUTH_KEY' => '',
		'DES_KEY' => '' 
);
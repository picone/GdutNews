<?php
return array (
		'DB_TYPE' => 'pdo',
		'DB_DSN' => 'sqlsrv:Server=192.168.186.128;database=NewsPublishSystem',
		'DB_USER' => 'gdut',
		'DB_PWD' => '123',
		'DB_PREFIX' => '',
		'CACHE_NAVIGATION' => 86400, // 导航栏缓存时间
		'CACHE_INDEX' => 300, // 首页新闻缓存时间
		'CACHE_CATEGORY' => 60, // 具体分类下新闻列表缓存时间
		'CACHE_PASSAGE' => 1800, // 每篇新闻缓存时间
		'CACHE_SEARCH' => 3600, // 搜索结果缓存时间
		'PASSAGE_LEN' => 30, // 新闻列表每页数目
		'LOGIN_USERNAME' => 'gdutnews', // 登录用户名
		'LOGIN_PASSWORD' => 'newsgdut', // 登录密码
		'AUTH_KEY' => 'gdut!~@', // COOKIE密钥
		'DEFAULT_FILTER' => 'htmlspecialchars,addslashes',
		header ( "Content-Type: text/html; charset=utf-8" ) 
); 

<?php

namespace Home\Model;

use Think\Model;

class UserModel extends Model {
	protected $tableName = 'User';
	protected $fields = array (
			'UserID',
			'Email',
			'Password',
			'RealName' 
	);
}
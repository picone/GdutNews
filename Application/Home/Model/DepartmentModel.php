<?php

namespace Home\Model;

use Think\Model;

class DepartmentModel extends Model {
	protected $tableName = 'Department';
	protected $fields = array (
			'DepartmentID',
			'DepartmentName',
			'DepartmentSequence',
			'DepartmentManagePassword' 
	);
}
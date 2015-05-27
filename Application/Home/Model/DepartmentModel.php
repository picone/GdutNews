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
	public function getAll() {
		return $this->query ( 'SELECT [DepartmentID],[DepartmentName] FROM [Department] ORDER BY DepartmentSequence' );
	}
}
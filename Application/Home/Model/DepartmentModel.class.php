<?php

namespace Home\Model;

use Think\Model;

class DepartmentModel extends Model {
	protected $tableName = 'Department';
	protected $fields = array (
			'DepartmentID',
			'DepartmentName',
			'DepartmentSequence' 
	);
	
	/**
	 * 获取所有部门的ID和名字
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->field ( 'DepartmentID,DepartmentName,DepartmentSequence' )->order ( 'DepartmentSequence' )->select ();
	}
}
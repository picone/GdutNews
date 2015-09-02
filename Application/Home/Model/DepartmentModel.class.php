<?php
namespace Home\Model;
class DepartmentModel extends \Think\Model {
	protected $tableName = 'Department';
	protected $fields = array (
			'DepartmentID',
			'DepartmentName',
			'DepartmentSequence',
			'DepartmentManagePassword' 
	);

	public function getAll() {
		$dapartment=S('all_dapartment');
		if(!$dapartment){
			$dapartment=$this->query ( 'SELECT [DepartmentID],[DepartmentName] FROM [Department] ORDER BY DepartmentSequence' );
			S('all_dapartment',$dapartment);
		}
		return $dapartment;
	}
}
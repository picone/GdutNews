<?php

namespace Home\Model;

use Think\Model;

class Categories2Model extends Model {
	protected $tableName = 'Categories2';
	protected $fields = array (
			'ID',
			'Name',
			'CategoryID' 
	);
	
	/**
	 * 获取指定一级分类的二级分类
	 *
	 * @param int $id 一级分类ID
	 * @return array 分类的ID和名字
	 */
	public function get($id) {
		return $this->field ( 'ID,Name' )->where ( 'CategoryID=%d', $id )->select ();
	}
}
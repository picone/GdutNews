<?php

namespace Home\Model;

use Think\Model;

class CategoriesModel extends Model {
	protected $tableName = 'Categories';
	protected $fields = array (
			'CategoryID',
			'CategoryName',
			'CategorySequence' 
	);
	
	/**
	 * 获取所有一级分类的ID和名字
	 *
	 * @return array
	 */
	public function getAll() {
		return $this->field ( 'CategoryID,CategoryName' )->order ( 'CategorySequence' )->select ();
	}
	/**
	 * 获取导航栏，未调用
	 *
	 * @return array
	 */
	public function getCategory() {
		$category = S ( 'category' );
		if (! $category) {
			$data = $this->getAll ();
			foreach ( $data as &$v ) {
				$t = D ( 'Categories2' )->get ( $v ['categoryid'] );
				$category [$v ['categoryid']] ['name'] = $v ['categoryname'];
				if (isset ( $t [0] )) {
					$category [$v ['categoryid']] ['data'] [0] = '全部' . substr ( $v ['categoryname'], 6 ); // 当目录名不是4个中文字符时会显示错误
					foreach ( $t as &$v2 ) {
						$category [$v ['categoryid']] ['data'] [$v2 ['id']] = $v2 ['name'];
					}
				}
			}
			S ( 'category', $category, C ( 'CACHE_NAVIGATION' ) );
		}
		return $category;
	}
}
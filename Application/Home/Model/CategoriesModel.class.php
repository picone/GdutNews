<?php

namespace Home\Model;

class CategoriesModel extends \Think\Model {
	protected $tableName = 'Categories';
	protected $fields = array (
			'CategoryID',
			'CategoryName',
			'CategorySequence' 
	);
	public function getAll() {
		$category = S ( 'all_category' );
		if (! $category) {
			$category = $this->query ( 'SELECT [CategoryID],[CategoryName] FROM [Categories] ORDER BY CategorySequence' );
			S ( 'all_category', $category );
		}
		return $category;
	}
	public function getCategory() { // 获取导航栏
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
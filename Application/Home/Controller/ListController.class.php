<?php

namespace Home\Controller;

use Think\Controller;

class ListController extends Controller {
	public function index($category = 0, $category2 = 0) {
		$data = D ( 'Categories' )->getCategory ();
		$category_name = $category2 ? $data [$category] ['data'] [$category2] : $data [$category] ['name'];
		$this->assign ( 'title', $category_name );
		$this->assign ( 'category_name', $category_name );
		$this->assign ( 'data', D ( 'Articles' )->getTitle ( $category, $category2, 1 ) );
		$this->assign ( 'category', $category );
		$this->assign ( 'category2', $category2 );
		$this->display ();
	}
	public function page($category = 0, $category2 = 0, $page = 1) {
		$this->ajaxReturn ( D ( 'Articles' )->getTitle ( $category, $category2, $page ) );
	}
}
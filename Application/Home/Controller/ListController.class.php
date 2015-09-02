<?php

namespace Home\Controller;

class ListController extends \Think\Controller {
	public function index($category = 0, $category2 = 0) {
		$data = D ( 'Categories' )->getCategory ();
		$this->assign ( 'title', $category2 ? $data [$category] ['data'] [$category2] : $data [$category] ['name'] );
		$this->assign ( 'category', $category );
		$this->assign ( 'category2', $category2 );
		$this->assign ( 'category_name', $this->get ( 'title' ) );
		$this->assign ( 'data', D ( 'Articles' )->getTitle ( $category, $category2, 1 ) );
		$this->display ();
	}
	public function page($category = 0, $category2 = 0, $page = 1) {
		$this->ajaxReturn ( D ( 'Articles' )->getTitle ( $category, $category2, $page ) );
	}
}
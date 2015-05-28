<?php

namespace Home\Controller;

class IndexController extends \Think\Controller {
	public function index() {
		// 当日新闻加载
		$this->assign ( 'notice', D ( 'Articles' )->getLatest ( 4, 12 ) );
		$this->assign ( 'announce', D ( 'Articles' )->getLatest ( 5, 5 ) );
		$this->assign ( 'note', D ( 'Articles' )->getLatest ( 6, 4 ) );
		// 导航栏分类加载
		// $this->assign ( 'category', D ( 'Categories' )->getCategory () );
		$this->display ('test');
	}
}
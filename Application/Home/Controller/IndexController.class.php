<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function index($page = 1) {
		// 最近新闻加载
		$this->assign ( 'data', D ( 'Articles' )->getLatest ( 0, $page ) );
		$this->display ();
	}
}
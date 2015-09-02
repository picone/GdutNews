<?php

namespace Home\Controller;

class SearchController extends \Think\Controller {
	public function index() {
		$this->assign ( 'department', D ( 'Department' )->getAll () );
		$this->assign ( 'category', D ( 'Categories' )->getAll () );
		$this->display ();
	}
	public function search($page = 1) {
		try {
			if (! IS_POST)
				throw new \Exception ( '请求类型错误' );
			$keyword = strtr ( I ( 'post.keyword', '', '' ), array (
					'%' => '',
					'<' => '',
					'>' => '',
					'\'' => '',
					'/' => '',
					' ' => '',
					'(' => '',
					')' => '' 
			) );
			if ($keyword == '')
				throw new \Exception ( '请输入关键词' );
			$type = I ( 'post.type/d', 0 );
			if ($type < 0 || $type > 2)
				throw new \Exception ( '搜索类型有误' );
			$date_from = I ( 'post.date_from/s', '' );
			if ($date_from != '' && ! preg_match ( '/^\d{4}-\d{1,2}-\d{1,2}$/', $date_from ))
				throw new \Exception ( '起始日期有误' );
			$date_to = I ( 'post.date_to/s', '' );
			if ($date_to != '' && ! preg_match ( '/^\d{4}-\d{1,2}-\d{1,2}$/', $date_to ))
				throw new \Exception ( '终止日期有误' );
			$page = ( int ) $page;
			if ($page <= 0)
				$page = 1;
			$data = D ( 'Articles' )->search ( $keyword, $type, I ( 'post.department/d', 0 ), I ( 'post.category/d', 0 ), $date_from, $date_to, $page );
			if ($page == 1) {
				$this->assign ( 'data', $data );
				$this->assign ( 'keyword', $keyword );
				$this->assign ( 'type', $type );
				$this->assign ( 'department', I ( 'post.department/d', 0 ) );
				$this->assign ( 'category', I ( 'post.category/d', 0 ) );
				$this->assign ( 'date_from', $date_from );
				$this->assign ( 'date_to', $date_to );
				$this->display ();
			} else {
				$this->ajaxReturn ( $data );
			}
		} catch ( \Exception $e ) {
			$this->error ( $e->getMessage () );
		}
	}
}
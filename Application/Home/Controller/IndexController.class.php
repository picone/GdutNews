<?php

namespace Home\Controller;

class IndexController extends \Think\Controller {
	public function index() {
		// 最近新闻加载
		$this->assign ( 'data', array (
				// array('name'=>'最近热点','data'=>D('Articles')->getHot(0)),
				array (
						'id' => C ( 'SCHOOL_NOTICE' ),
						'name' => '最新通知',
						'data' => D ( 'Articles' )->getLatest ( C ( 'SCHOOL_NOTICE' ) ) 
				),
				array (
						'id' => C ( 'SCHOOL_ANNOUNCEMENT' ),
						'name' => '最新公告',
						'data' => D ( 'Articles' )->getLatest ( C ( 'SCHOOL_ANNOUNCEMENT' ) ) 
				),
				array (
						'id' => C ( 'SCHOOL_NEWSLETTER' ),
						'name' => '最新简讯',
						'data' => D ( 'Articles' )->getLatest ( C ( 'SCHOOL_NEWSLETTER' ) ) 
				) 
		) );
		$this->display ();
	}
}
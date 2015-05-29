<?php

namespace Home\Controller;

class IndexController extends \Think\Controller {
	public function index() {
		$this->assign('title','广东工业大学新闻通知网');
 		// 最近新闻加载
		$this->assign('data',array(
			array('name'=>'最新通知','data'=>D ( 'Articles' )->getLatest ( 4,12 )),
			array('name'=>'最新公告','data'=>D ( 'Articles' )->getLatest ( 5,5 )),
			array('name'=>'最新简讯','data'=>D ( 'Articles' )->getLatest ( 6,4 ))
		));
 		// 导航栏分类加载
// 		$this->assign ( 'category', D ( 'Categories' )->getCategory () );
		$this->display ();
	}
}
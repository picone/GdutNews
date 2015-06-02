<?php

namespace Home\Controller;

class IndexController extends \Think\Controller {
	public function index() {
 		// 最近新闻加载
		$this->assign('data',array(
			//array('name'=>'最近热点','data'=>D('Articles')->getHot(0,5)),
			array('id'=>4,'name'=>'最新通知','data'=>D('Articles')->getLatest(4,12)),
			array('id'=>5,'name'=>'最新公告','data'=>D('Articles')->getLatest(5,5)),
			array('id'=>6,'name'=>'最新简讯','data'=>D('Articles')->getLatest(6,4))
		));
		$this->display ();
	}
}
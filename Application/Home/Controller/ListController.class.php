<?php
namespace Home\Controller;
class ListController extends \Think\Controller {

	public function index($category=0,$category2=0) {
		$this->assign('category',$category);
		$this->assign('category2',$category2);
		$this->display();
	}
}
<?php
namespace Home\Controller;
class ArticleController extends \Think\Controller {
	public function index($id=0){
		if($id!=0){
			$data=D('Articles')->getPassage($id);
			$this->assign('title',$data['title']);
			$this->assign('data',$data);
		}
		$this->display();
	}
}
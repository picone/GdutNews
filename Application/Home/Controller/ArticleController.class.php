<?php
namespace Home\Controller;
class ArticleController extends \Think\Controller {
	public function index($id=0){
		if($id!=0){
			$data=D('Articles')->getPassage($id);
			$category=D('Categories')->getCategory();
			$this->assign('category',$data['categoryid']);
			$this->assign('category2',$data['categoryid2']);
			$this->assign('title',$data['title']);
			$this->assign('category_name',$data['categoryid2']==0?$category[$data['categoryid']]['name']:$category[$data['categoryid']]['data'][$data['categoryid2']]);
			$content=str_replace('<table','<table class="table table-bordered table-striped"',$data['content']);
			$this->assign('content',$content);
		}
		$this->display();
	}
}
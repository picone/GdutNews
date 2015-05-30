<?php
namespace Home\Controller;
class SearchController extends \Think\Controller {

	public function index(){
		$this->display();
	}

	public function search(){
		if(IS_POST){
			$this->display('List/index');
		}else{
			$this->error('非法操作');
		}
	}
}
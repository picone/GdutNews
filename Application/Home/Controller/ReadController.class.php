<?php

namespace Home\Controller;

use Think\Controller;

class ReadController extends Controller {

	public function passage($id = 0) {
		$this->ajaxReturn ( D ( 'Articles' )->getPassage ( $id ) );
	}

	public function title($category = 0, $category2 = 0, $page = 1) {
		if ($page >= 1) {
			$data = D ( 'Categories' )->getCategory ();
			if (isset ( $data [$category] )) {
				foreach ( $data [$category] ['data'] as &$val ) {
					if ($category2 == $val ['id']) {
						$this->ajaxReturn ( array (
								't' => $val ['name'],
								'c' => D ( 'Articles' )->getTitle ( $category, $category2, $page ) 
						) );
						break;
					}
				}
			}
		}
		$this->ajaxReturn ( array () );
	}

	public function search(){
		if(IS_POST){
			$keyword=I('post.keyword/s','');
			if($keyword!=''){
				$this->ajaxReturn($data=D('Articles')->search($keyword,I('post.category/d',0),I('post.department/d',0),I('post.date_from','','/^\d{4}\-\d{1,2}\-\d{1,2}$/'),I('post.date_to','','/^\d{4}\-\d{1,2}\-\d{1,2}$/')));
			}else{
				$this->error();
			}
		}else{
			$this->error();
		}
	}
}
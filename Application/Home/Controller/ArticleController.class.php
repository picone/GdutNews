<?php

namespace Home\Controller;

use Think\Controller;

class ArticleController extends Controller {
	public function index($id = 0) {
		$data = D ( 'Articles' )->getPassage ( $id );
		$category = D ( 'Categories' )->getCategory ();
		$this->assign ( 'title', $data ['title'] );
		$this->assign ( 'department', $data ['departmentname'] );
		$this->assign ( 'category', $data ['categoryid'] );
		$this->assign ( 'category2', $data ['categoryid2'] );
		$this->assign ( 'content', $this->formatData ( $data ['content'] ) );
		$this->assign ( 'category_name', $data ['categoryid2'] == 0 ? $category [$data ['categoryid']] ['name'] : $category [$data ['categoryid']] ['data'] [$data ['categoryid2']] );
		$this->display ();
	}
	private function formatData($content) {
		if ($content != null) {
			// 为表格添加响应式表格样式
			$content = preg_replace ( '/\<table/', '<div class="table-responsive"><table class="table table-striped table-bordered table-hover"', $content );
			$content = preg_replace ( '/\<\/table\>/', '</table></div>', $content );
			// 为图片添加超级链接在新窗口打开,并添加响应式图片样式
			$content = preg_replace ( '/\<img.*?src=\"(.*?)\".*?\>/', '<a href="${1}" target="_blank"><img src="${1}" alt="图片" class="img-responsive"/></a>', $content );
			// 替换空格
			$content = preg_replace ( '/[ ]{2,}/', '&nbsp;', $content );
			// 删除大于8个的空格
			$content = preg_replace ( '/(&nbsp;){9,}/', '', $content );
			// 删除自定义字体大小
			$content = preg_replace ( '/font\-size\:[ ]*\d+(px|em|pt|ex|pc|in|mm|cm)/', '', $content );
			$content = preg_replace ( '/size\=\"\d+\"(?=.*?\>)/', '', $content );
		}
		return $content;
	}
}
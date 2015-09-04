<?php

namespace Home\Controller;

class ArticleController extends \Think\Controller {
	public function index($id = 0) {
		if ($id != 0) {
			$data = D ( 'Articles' )->getPassage ( $id );
			$category = D ( 'Categories' )->getCategory ();
			$this->assign ( 'category', $data ['categoryid'] );
			$this->assign ( 'category2', $data ['categoryid2'] );
			$this->assign ( 'title', $data ['title'] );
			$this->assign ( 'category_name', $data ['categoryid2'] == 0 ? $category [$data ['categoryid']] ['name'] : $category [$data ['categoryid']] ['data'] [$data ['categoryid2']] );
			$content = $data ['content'];
			$content = $this->formatData ( $content );
			$this->assign ( 'content', $content );
		}
		$this->display ();
	}
	function formatData($content) {
		if ($content != null) {
			// 为表格添加响应式表格样式
			$content = str_replace ( '<table', '<div class="table-responsive"><table class="table table-bordered table-hover"', $content );
			$content = str_replace ( '</table>', '</table></div>', $content );
			// 为图片添加超级链接在新窗口打开,并添加响应式图片样式
			$content = preg_replace ( '/<img.*?src="(.*?)".*?>/', '<a href="${1}" target="_blank"><img src="${1}" alt="图片" class="img-responsive"/></a>', $content );
		}
		return $content;
	}
}
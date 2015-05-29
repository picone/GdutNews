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
	public function search() {
		if (IS_POST) {
			$keyword = I ( 'post.keyword/s', '' );
			if ($keyword != '') {
				$this->ajaxReturn ( $data = D ( 'Articles' )->search ( $keyword, I ( 'post.searchtype/d', 0 ), I ( 'post.department/d', 0 ), I ( 'post.category/d', 0 ), I ( 'post.date_from', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' ), I ( 'post.date_to', '', '/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/' ) ) );
				// 日期（YYYY-MM-DD）的正则表达式为/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/
				// 时间（hh:mm:ss）的正则表达式为 /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])$/
			} else {
				$this->error ();
			}
		} else {
			$this->error ();
		}
	}
}
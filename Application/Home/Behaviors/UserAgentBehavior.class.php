<?php

namespace Home\Behaviors;

class UserAgentBehavior {
	public function run(&$param) {
		Vendor ( 'MobileDetect.Mobile_Detect' );
		$mobile = new \Mobile_Detect ();
		if (! $mobile->isMobile ()) {
			$url = $_SERVER ['PATH_INFO'];
			$url = explode ( '/', $url );
			if (isset ( $url [1] )) {
				if (strcmp ( $url [1], 'Login' ) == 0) {
					redirect ( 'http://news.gdut.edu.cn/UserLogin.aspx' );
				} else if (strcmp ( $url [1], 'List' ) == 0 && isset ( $url [3] )) {
					if (isset ( $url [4] )) {
						redirect ( 'http://news.gdut.edu.cn/ArticleList.aspx?category=' . $url [3] . '&category2=' . $url [4] );
					} else {
						redirect ( 'http://news.gdut.edu.cn/ArticleList.aspx?category=' . $url [3] );
					}
				} else if (strcmp ( $url [1], 'Article' ) == 0 && isset ( $url [3] )) {
					redirect ( 'http://news.gdut.edu.cn/viewarticle.aspx?articleid=' . $url [3] );
				}
			}
			redirect ( 'http://news.gdut.edu.cn/' );
		}
	}
}
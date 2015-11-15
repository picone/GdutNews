<?php

namespace Home\Behaviors;

class UserAgentBehavior {
	public function run(&$param) {
		if (cookie ( 'isMobile' ) == null) {
			Vendor ( 'MobileDetect.Mobile_Detect' );
			$mobile = new \Mobile_Detect ();
			cookie ( 'isMobile', $mobile->isMobile () );
		}
		if (! cookie ( 'isMobile' )) {
			$url = $_SERVER ['PATH_INFO'];
			$url = explode ( '/', $url );
			$str = 'http://news.gdut.edu.cn/';
			if (isset ( $url [1] )) {
				if (strcmp ( $url [1], 'Login' ) == 0) {
					if (isset ( $url [2] ) && strcmp ( $url [2], 'lost' ) == 0) {
						$str .= 'FindPassword.aspx';
					} else {
						$str .= 'UserLogin.aspx';
					}
				} else if (strcmp ( $url [1], 'List' ) == 0 && isset ( $url [3] )) {
					$str .= 'ArticleList.aspx?category=' . $url [3];
					if (isset ( $url [4] )) {
						$str .= '&category2=' . $url [4];
					}
				} else if (strcmp ( $url [1], 'Article' ) == 0 && isset ( $url [3] )) {
					$str .= 'viewarticle.aspx?articleid=' . $url [3];
				} else {
					$str .= 'default.aspx';
				}
			} else {
				$str .= 'default.aspx';
			}
			redirect ( $str );
		}
	}
}
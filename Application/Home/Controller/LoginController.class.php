<?php

namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller {
	public function index() {
		$this->display ( 'index' );
	}
	public function login() {
		if (IS_POST) {
			if (I ( 'post.un' ) == C ( 'LOGIN_USERNAME' ) && I ( 'post.passwd' ) == C ( 'LOGIN_PASSWORD' )) {
				cookie ( 'auth', authcode ( implode ( '\t', array (
						I ( 'post.un' ),
						I ( 'post.passwd' ) 
				) ), 'ENCODE' ), I ( 'post.remember', '0' ) == 0 ? 0 : 7776000 );
				redirect ( U ( 'Index/index' ) );
			} else {
				$this->assign ( 'output', '账号或密码错误!' );
				$this->display ( 'index' );
			}
		} else {
			$this->error ( '非法操作' );
		}
	}
}
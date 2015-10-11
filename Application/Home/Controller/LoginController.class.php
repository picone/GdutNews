<?php

namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller {
	public function index() {
		cookie ( 'auth', null );
		session ( null );
		$this->display ();
	}
	public function login() {
		if (IS_POST) {
			if (D ( 'User' )->login ( I ( 'post.un' ), I ( 'post.passwd' ) )) {
				cookie ( 'auth', authcode ( implode ( '\t', array (
						I ( 'post.un' ),
						I ( 'post.passwd' ) 
				) ), 'ENCODE' ), I ( 'post.remember', 0 ) == 0 ? 0 : 2592000 );
				session ( 'isLogin', true );
				redirect ( __APP__ . '/' . $GLOBALS ['url'] );
			} else {
				$this->assign ( 'un', I ( 'post.un' ) );
				$this->assign ( 'passwd', I ( 'post.passwd' ) );
				$this->assign ( 'output', '账号或密码错误!' );
				$this->display ( 'index' );
			}
		} else {
			$this->error ( '非法操作' );
		}
	}

	public function findPassword() {
		$this->display ( 'findPassword' );
	}
}
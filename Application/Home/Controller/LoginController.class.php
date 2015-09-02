<?php

namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller {

	public function index() {
		$this->display ();
	}

	public function login() {
		if (IS_POST) {
            if(D('User')->login(I('post.un'),I('post.passwd'))){
				cookie ( 'auth', authcode ( implode ( '\t', array (
						I ( 'post.un' ),
						I ( 'post.passwd' ) 
				) ), 'ENCODE' ), I ( 'post.remember', 0 ) == 0 ? 0 : 7776000 );
				redirect ( __APP__ );
			} else {
                $this->assign('un',I('post.un'));
                $this->assign('passwd',I('post.passwd'));
				$this->assign ( 'output', '账号或密码错误!' );
				$this->display ( 'index' );
			}
		} else {
			$this->error ( '非法操作' );
		}
	}
}
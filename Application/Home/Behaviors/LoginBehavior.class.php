<?php

namespace Home\Behaviors;

class LoginBehavior extends \Think\Behavior {
	public function run(&$param) {
		if (CONTROLLER_NAME != 'Login') {
			$auth = authcode(cookie( 'auth' ));
			if ($auth == '') {
                redirect(__APP__.'/Login');
			} else {
				list($username,$password)=explode( '\t',$auth);
                $GLOBALS['username']=D('User')->login($username,$password);
                if(!$GLOBALS['username']){
                    redirect(__APP__.'/Login');
                }
			}
		}
	}
}
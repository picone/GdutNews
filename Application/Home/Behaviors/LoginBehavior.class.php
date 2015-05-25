<?php

namespace Home\Behaviors;

class LoginBehavior extends \Think\Behavior {
	public function run(&$param) {
<<<<<<< HEAD
		if (CONTROLLER_NAME != 'Login') {
			import ( 'Org.Util.Authcode' );
			$auth = (new \Org\Util\Atuhcode ())->authcode ( cookie ( 'auth' ) );
			if ($auth == '') {
				redirect ( U ( 'Login/index' ) );
			} else {
				$tmp = explode ( '\t', $auth );
				if ($tmp [0] != C ( 'LOGIN_USERNAME' ) || $tmp [1] != C ( 'LOGIN_PASSWORD' ))
					redirect ( U ( 'Login/index' ) );
			}
		}
=======
		// if(CONTROLLER_NAME!='Login'){
		// import('Org.Util.Authcode');
		// $auth=(new \Org\Util\Atuhcode())->authcode(cookie('auth'));
		// if($auth==''){
		// redirect(U('Login/index'));
		// }else{
		// $tmp=explode('\t',$auth);
		// if($tmp[0]!=C('LOGIN_USERNAME')||$tmp[1]!=C('LOGIN_PASSWORD'))redirect(__APP__.'/Login');
		// }
		// }
>>>>>>> origin/master
	}
}
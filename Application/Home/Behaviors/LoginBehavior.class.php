<?php

namespace Home\Behaviors;

class LoginBehavior extends \Think\Behavior {
	public function run(&$param) {
		if (CONTROLLER_NAME != 'Login') {
			$auth = authcode ( cookie ( 'auth' ) );
			if ($auth == '') {
				redirect ( U ( 'Login/index' ) );
			} else {
				$tmp = explode ( '\t', $auth );
				if ($tmp [0] != C ( 'LOGIN_USERNAME' ) || $tmp [1] != C ( 'LOGIN_PASSWORD' ))
					redirect ( U ( 'Login/index' ) );
			}
		}
	}
}
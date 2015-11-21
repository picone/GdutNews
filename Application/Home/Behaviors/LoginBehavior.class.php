<?php

namespace Home\Behaviors;

class LoginBehavior {
	public function run(&$param) {
		if (CONTROLLER_NAME != 'Login') {
			$auth = authcode ( cookie ( 'auth' ) );
			if ($auth == '') {
				$ip = get_client_ip ();
				if (! isLan ( $ip )) {
					session ( 'url', $_SERVER ['PATH_INFO'] );
					redirect ( __APP__ . '/Login' );
				} else {
					$GLOBALS ['username'] = '游客';
				}
			} else {
				list ( $username, $password ) = explode ( '\t', $auth );
				$GLOBALS ['username'] = D ( 'User' )->login ( $username, $password );
				if (! $GLOBALS ['username']) {
					session ( 'url', $_SERVER ['PATH_INFO'] );
					redirect ( __APP__ . '/Login' );
				}
			}
		}
	}
}
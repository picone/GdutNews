<?php

namespace Home\Behaviors;

class LoginBehavior {
	public function run(&$param) {
		if (CONTROLLER_NAME != 'Login') {
			$auth = authcode ( cookie ( 'auth' ) );
			if ($auth == '') {
				$ip = get_client_ip ();
				if (! isLan ( $ip )) {
					$GLOBALS ['url'] = $_SERVER ['PATH_INFO'];
					redirect ( __APP__ . '/Login' );
				} else {
					$GLOBALS ['username'] = '游客';
					session ( 'username', $GLOBALS ['username'] );
				}
			} else {
				if (! session ( 'isLogin' )) {
					list ( $username, $password ) = explode ( '\t', $auth );
					$GLOBALS ['username'] = D ( 'User' )->login ( $username, $password );
					if (! $GLOBALS ['username']) {
						$GLOBALS ['url'] = $_SERVER ['PATH_INFO'];
						redirect ( __APP__ . '/Login' );
					} else {
						session ( 'isLogin', true );
						session ( 'username', $GLOBALS ['username'] );
					}
				}
			}
		}
	}
}
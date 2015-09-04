<?php

namespace Home\Model;

class UserModel extends \Think\Model {
	protected $tableName = 'User';
	protected $fields = array (
			'UserID',
			'Email',
			'Password',
			'RealName' 
	);
	public function login($username, $password) {
		$result = false;
		if ($username === C ( 'LOGIN_USERNAME' )) {
			if ($password === C ( 'LOGIN_PASSWORD' ))
				$result = '游客';
		} else {
			$data = $this->query ( 'SELECT [Password],[RealName] FROM [User] WHERE [Email]=\'' . $username . '\'' );
			if (isset ( $data [0] )) {
				$iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB ), MCRYPT_RAND );
				$passwd = mcrypt_decrypt ( MCRYPT_RIJNDAEL_128, C ( 'DES_KEY' ), base64_decode ( $data [0] ['password'] ), MCRYPT_MODE_ECB, $iv );
				$passwd = iconv ( 'UTF-16LE', 'UTF-8', $passwd );
				if (strcmp ( $passwd, $password ) == 0)
					$result = $data [0] ['realname'];
			}
		}
		return $result;
	}
}
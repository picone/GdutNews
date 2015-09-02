<?php
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
	$ckey_length = 4;
	$key = md5 ( $key != '' ? $key : C ( 'AUTH_KEY' ) );
	$keya = md5 ( substr ( $key, 0, 16 ) );
	$keyb = md5 ( substr ( $key, 16, 16 ) );
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';
	
	$cryptkey = $keya . md5 ( $keya . $keyc );
	$key_length = strlen ( $cryptkey );
	
	$string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
	$string_length = strlen ( $string );
	
	$result = '';
	$box = range ( 0, 255 );
	
	$rndkey = array ();
	for($i = 0; $i <= 255; $i ++) {
		$rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
	}
	
	for($j = $i = 0; $i < 256; $i ++) {
		$j = ($j + $box [$i] + $rndkey [$i]) % 256;
		$tmp = $box [$i];
		$box [$i] = $box [$j];
		$box [$j] = $tmp;
	}
	
	for($a = $j = $i = 0; $i < $string_length; $i ++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box [$a]) % 256;
		$tmp = $box [$a];
		$box [$a] = $box [$j];
		$box [$j] = $tmp;
		$result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
	}
	
	if ($operation == 'DECODE') {
		if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) {
			return substr ( $result, 26 );
		} else {
			return '';
		}
	} else {
		return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
	}
}
function isMobile() {
	if (isset ( $_SERVER ['HTTP_X_WAP_PROFILE'] )) {
		return true;
	}
	if (isset ( $_SERVER ['HTTP_VIA'] )) {
		return stristr ( $_SERVER ['HTTP_VIA'], "wap" ) ? true : false;
	}
	if (isset ( $_SERVER ['HTTP_USER_AGENT'] )) {
		$clientkeywords = array (
				'nokia',
				'sony',
				'ericsson',
				'mot',
				'samsung',
				'htc',
				'sgh',
				'lg',
				'sharp',
				'sie-',
				'philips',
				'panasonic',
				'alcatel',
				'lenovo',
				'iphone',
				'ipod',
				'blackberry',
				'meizu',
				'android',
				'netfront',
				'symbian',
				'ucweb',
				'windowsce',
				'palm',
				'operamini',
				'operamobi',
				'openwave',
				'nexusone',
				'cldc',
				'midp',
				'wap',
				'mobile' 
		);
		// 从HTTP_USER_AGENT中查找手机浏览器的关键字
		if (preg_match ( "/(" . implode ( '|', $clientkeywords ) . ")/i", strtolower ( $_SERVER ['HTTP_USER_AGENT'] ) )) {
			return true;
		}
	}
	if (isset ( $_SERVER ['HTTP_ACCEPT'] )) {
		if ((strpos ( $_SERVER ['HTTP_ACCEPT'], 'vnd.wap.wml' ) !== false) && (strpos ( $_SERVER ['HTTP_ACCEPT'], 'text/html' ) === false || (strpos ( $_SERVER ['HTTP_ACCEPT'], 'vnd.wap.wml' ) < strpos ( $_SERVER ['HTTP_ACCEPT'], 'text/html' )))) {
			return true;
		}
	}
	return false;
}

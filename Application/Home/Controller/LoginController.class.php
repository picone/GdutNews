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
			$GLOBALS ['username'] = D ( 'User' )->login ( I ( 'post.un/s' ), I ( 'post.passwd/s' ) );
			if ($GLOBALS ['username']) {
				cookie ( 'auth', authcode ( implode ( '\t', array (
						I ( 'post.un/s' ),
						I ( 'post.passwd/s' ) 
				) ), 'ENCODE' ), I ( 'post.remember/d', 0 ) == 0 ? 0 : 2592000 );
				redirect ( __APP__ . '/' . $GLOBALS ['url'] );
			} else {
				$this->assign ( 'un', I ( 'post.un/s' ) );
				$this->assign ( 'output', '账号或密码错误!' );
				$this->display ( 'index' );
			}
		} else {
			$this->error ( '非法操作' );
		}
	}
	public function lost() {
		$ch = curl_init ( 'http://news.gdut.edu.cn/FindPassword.aspx' );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.4.2; en-us;)' );
		curl_setopt ( $ch, CURLOPT_HEADER, 1 );
		$page = curl_exec ( $ch );
		session ( 'state', $this->_substr ( $page, 'id="__VIEWSTATE" value="', '"' ) );
		session ( 'validation', $this->_substr ( $page, 'id="__EVENTVALIDATION" value="', '"' ) );
		session ( 'session_id', $this->_substr ( $page, 'ASP.NET_SessionId=', ';' ) );
		$this->display ();
		curl_close ( $ch );
	}
	public function vcode() {
		header ( 'Content-Type:image/Jpeg;' );
		$ch = curl_init ( 'http://news.gdut.edu.cn/ValidateCode.aspx' );
		curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.4.2; en-us;)' );
		curl_setopt ( $ch, CURLOPT_COOKIE, 'ASP.NET_SessionId=' . session ( 'session_id' ) );
		curl_exec ( $ch );
		curl_close ( $ch );
	}
	public function post() {
		if (IS_POST) {
			$fields = array (
					'__VIEWSTATE' => session ( 'state' ),
					'__EVENTVALIDATION' => session ( 'validation' ),
					'ctl00$ContentPlaceHolder1$TextBox1' => I ( 'post.email/s', '' ),
					'ctl00$ContentPlaceHolder1$TextBox2' => I ( 'post.name/s' ),
					'ctl00$ContentPlaceHolder1$TextBox3' => I ( 'post.vcode/s' ),
					'ctl00$ContentPlaceHolder1$Button1' => '取回密码' 
			);
			$ch = curl_init ( 'http://news.gdut.edu.cn/FindPassword.aspx' );
			curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; U; Android 4.4.2; en-us;)' );
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $fields ) );
			curl_setopt ( $ch, CURLOPT_COOKIE, 'ASP.NET_SessionId=' . session ( 'session_id' ) );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			$page = curl_exec ( $ch );
			$this->assign ( 'email', I ( 'post.email/s', '' ) );
			$this->assign ( 'name', I ( 'post.name/s' ) );
			$this->assign ( 'output', $this->_substr ( $page, 'alert("', '"' ) );
			$this->display ( 'lost' );
			curl_close ( $ch );
		} else {
			$this->error ( '非法操作' );
		}
	}
	private function _substr($str, $start, $end) {
		$pos1 = strpos ( $str, $start ) + strlen ( $start );
		$pos2 = strpos ( $str, $end, $pos1 );
		return substr ( $str, $pos1, $pos2 - $pos1 );
	}
}
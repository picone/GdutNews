<?php

namespace Home\Behaviors;

class UserAgentBehavior extends \Think\Behavior {
	public function run(&$param){
        if(!isMobile()){
            redirect('http://news.gdut.edu.cn/');
        }
	}
}
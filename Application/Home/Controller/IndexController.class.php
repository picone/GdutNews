<?php
namespace Home\Controller;
class IndexController extends \Think\Controller{

	protected function _initialize(){
		//当日新闻加载
		$today=date('Y-m-d',NOW_TIME);
		$this->assign('notice',D('Articles')->getLatest(4,$today));
		$this->assign('announce',D('Articles')->getLatest(5,$today));
		$this->assign('note',D('Articles')->getLatest(6,$today));
		//导航栏分类加载
		$this->assign('category',D('Categories')->getCategory());
	}

	public function index(){
		$this->display('index');
	}

    public function p($id=0){
        if($id==0){
            $this->assign('output','$.afui.ready(function(){$.afui.toast({message:\'新闻不存在\',position:\'tc\',type:\'error\'});});');
        }else{
            $this->assign('output','$.afui.ready(function(){p('.$id.');});');
        }
		$this->display('index');
    }
}
?>
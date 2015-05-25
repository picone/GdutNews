<?php
namespace Home\Model;
use Think\Model;
class CategoriesModel extends Model {
    protected $tableName='Categories';
    protected $fields=array('CategoryID','CategoryName','CategorySequence');

    public function getAll(){
        return $this->query('SELECT [CategoryID],[CategoryName] FROM [Categories] ORDER BY CategorySequence');
    }

    public function getCategory(){
        $category=S('category');
        if(!$category){
            $data=$this->getAll();
            foreach($data as &$v){
                $t=D('Categories2')->get($v['categoryid']);
                $category[$v['categoryid']]['name']=$v['categoryname'];
                $category[$v['categoryid']]['data'][]=array('id'=>0,'name'=>'全部'.substr($v['categoryname'],6));
                if(isset($t[0])){
                    foreach($t as &$v2){
                        $category[$v['categoryid']]['data'][]=array('id'=>$v2['id'],'name'=>$v2['name']);
                    }
                }
            }
            S('category',$category,C('CACHE_NAVIGATION'));
        }
        return $category;
    }
}
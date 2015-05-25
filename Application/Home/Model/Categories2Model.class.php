<?php
namespace Home\Model;
use Think\Model;
class Categories2Model extends Model {
    protected $tableName='Categories2';
    protected $fields=array('ID','Name','CategoryID');

    public function get($id){
        return $this->query('SELECT [ID],[Name] FROM [Categories2] WHERE CategoryID=%d',$id);
    }
}
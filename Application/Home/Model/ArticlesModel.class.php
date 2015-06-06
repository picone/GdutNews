<?php

namespace Home\Model;

use Think\Model;

class ArticlesModel extends Model {
	protected $tableName = 'Articles';
	protected $fields = array (
			'ArticleID',
			'Title',
			'Publisher',
			'CreateDate',
			'Updator',
			'UpdateDate',
			'CategoryID',
			'DepartmentID',
			'Content',
			'PublishDate',
			'Approved',
			'ViewCount',
			'CategoryID2' 
	);
	public function getPassage($id) { // 新闻详情
		$data = S ( 'passage' . $id );
		if (! $data) {
			$data = $this->query ( 'SELECT TOP 1 [Title],[Content],[CategoryID],[CategoryID2] FROM [Articles] WHERE ArticleID=%d', ( int ) $id );
			if (isset ( $data [0] )) {
				$data = $data [0];
				S ( 'passage' . $id, $data, C ( 'CACHE_PASSAGE' ) );
			} else {
				$data = array ();
			}
		}
		return $data;
	}
	public function getLatest($id, $count) { // 获取最新count条新闻
		$data = S ( 'index' . $id . '_' . $count );
		if (! $data) {
			$data = $this->query ( 'SELECT TOP %d [ArticleID],[Title],CONVERT(varchar(10),PublishDate,111) AS PublishDate,DATENAME(WEEKDAY,PublishDate) AS WeekDay,[DepartmentName] FROM [Articles] LEFT JOIN [Department] ON Articles.DepartmentID=Department.DepartmentID WHERE CategoryID=%d ORDER BY [PublishDate] DESC',(int)$count,( int ) $id );
			S ( 'index' . $id.'_'.$count, $data, C ( 'CACHE_INDEX' ) );
		}
		return $data;
	}
	public function getTitle($category, $category2, $page) { // 获取分类新闻标题
		$data = S ( 'title' . $category . '_' . $category2 . '_' . $page );
		if (! $data) {
			if ($category2 == 0)
				$tmp = $this->query ( 'SELECT TOP %d [ArticleID],[Title],CONVERT(varchar(10),PublishDate,111) AS PublishDate,DATENAME(WEEKDAY,PublishDate) AS WeekDay,[DepartmentName] FROM [Articles] LEFT JOIN [Department] ON Articles.DepartmentID=Department.DepartmentID WHERE CategoryID=%d AND ArticleID NOT IN (SELECT TOP %d [ArticleID] FROM [Articles] WHERE CategoryID=%d ORDER BY [PublishDate] DESC) ORDER BY [PublishDate] DESC', C ( 'PASSAGE_LEN' ), ( int ) $category, (( int ) $page - 1) * C ( 'PASSAGE_LEN' ), ( int ) $category );
			else
				$tmp = $this->query ( 'SELECT TOP %d [ArticleID],[Title],CONVERT(varchar(10),PublishDate,111) AS PublishDate,DATENAME(WEEKDAY,PublishDate) AS WeekDay,[DepartmentName] FROM [Articles] LEFT JOIN [Department] ON Articles.DepartmentID=Department.DepartmentID WHERE CategoryID=%d AND CategoryID2=%d AND ArticleID NOT IN (SELECT TOP %d [ArticleID] FROM [Articles] WHERE CategoryID=%d AND CategoryID2=%d ORDER BY [PublishDate] DESC) ORDER BY [PublishDate] DESC', C ( 'PASSAGE_LEN' ), ( int ) $category, ( int ) $category2, (( int ) $page - 1) * C ( 'PASSAGE_LEN' ), ( int ) $category, ( int ) $category2 );
			$data = array ();
			foreach ( $tmp as &$val ) {
				$data [$val ['publishdate'] . ' ' . $val ['weekday']] [] = array (
						'id' => $val ['articleid'],
						't' => $val ['title'],
						'd' => $val ['departmentname'] 
				);
			}
			S ( 'title' . $category . '_' . $category2 . '_' . $page, $data, C ( 'CACHE_CATEGORY' ) );
		}
		return $data;
	}
	public function search($keyword, $searchtype, $department, $category, $date_from, $date_to,$page) { // 搜索，未调用
		$data = S ( 'search_' . $keyword . '_' . $searchtype . '_' . $department . '_' . $category . '_' . $date_from . '_' . $date_to );
		if (! $data) {
			$sql = 'SELECT [ArticleID],[Title],CONVERT(varchar(10),PublishDate,111) AS PublishDate,DATENAME(WEEKDAY,PublishDate) AS WeekDay,[DepartmentName] FROM [Articles] LEFT JOIN [Department] ON Articles.DepartmentID = Department.DepartmentID';
			switch (( int ) $searchtype) {
				case 0 : // 标题搜索
					$sql .= ' WHERE [Title] LIKE \'%'.$keyword.'%\'';
					break;
				case 1 : // 内容搜索
					$sql .= ' WHERE [Content] LIKE \'%'.$keyword.'%\'';
					break;
				case 2 : // 全文搜索（标题和内容都匹配）
					$sql .= sprintf(' WHERE ([Title] LIKE \'%%%s%%\' OR [Content] LIKE \'%%%s%%\')',$keyword,$keyword);
					break;
			}
			if ($department != 0)
				$sql .= ' AND Articles.DepartmentID=' . ( int ) $department;
			if ($category != 0)
				$sql .= ' AND Articles.CategoryID=' . ( int ) $category;
			if ($date_from != '')
				$sql .= sprintf ( ' AND [PublishDate]>\'%s\'', $date_from );
			if ($date_to != '')
				$sql .= sprintf ( ' AND [PublishDate]<\'%s\'', $date_to );
			$sql .= ' ORDER BY [PublishDate] DESC';
			$data = $this->query ($sql);
			S ( 'search_' . $keyword . '_' . $searchtype . '_' . $department . '_' . $category . '_' . $date_from . '_' . $date_to, $data, C ( 'CACHE_SEARCH' ) );
		}
		return array_slice($data,($page-1)*C('PASSAGE_LEN'),C('PASSAGE_LEN'));
	}
	public function getHot($category,$count){
		$data = S ( 'hot' . $category);
		if(!$data){
			$sql='SELECT TOP '.(int)$count.' [ArticleID],[Title],CONVERT(varchar(10),PublishDate,111) AS PublishDate,DATENAME(WEEKDAY,PublishDate) AS WeekDay,[DepartmentName] FROM [Articles] LEFT JOIN [Department] ON Articles.DepartmentID=Department.DepartmentID WHERE PublishDate>DATEADD(DAY,-30,GETDATE())';
			if($category!=0){
				$sql.=' AND CategoryID='.(int)$category;
			}
			$sql.=' ORDER BY [ViewCount] DESC,[PublishDate] DESC';
			$data=$this->query($sql);
			S('hot' . $category,$data,C('CACHE_INDEX'));
		}
		return $data;
	}
}
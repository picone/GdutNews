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
			'ViewCount',
			'CategoryID2' 
	);
	
	/**
	 * 获取文章内容
	 *
	 * @param int $id 文章ID
	 * @return array 文章详细内容
	 */
	public function getPassage($id = 0) {
		return $this->field ( 'Title,Content,CategoryID,CategoryID2' )->where ( 'ArticleID=%d', $id )->find ();
	}
	
	/**
	 * 获取最新新闻
	 *
	 * @param int $id 类别的ID
	 * @param int $page 页数
	 * @return array 新闻记录集
	 */
	public function getLatest($id = 0, $page = 1) {
		$model = $this;
		if ($id > 0) {
			$model = $model->where ( 'CategoryID=%d', $id );
		}
		return $model->field ( 'ArticleID,Title,CONVERT(varchar(10),PublishDate,111) AS PublishDate,DATENAME(WEEKDAY,PublishDate) AS WeekDay,DepartmentName' )->join ( 'Department ON Articles.DepartmentID=Department.DepartmentID' )->order ( 'PublishDate DESC' )->page ( $page, C ( 'PASSAGE_LEN' ) )->select ();
	}
	
	/**
	 * 获取分类新闻标题
	 *
	 * @param int $category
	 * @param int $catefory2
	 * @param int $page
	 * @return array 对应分类按日期的分类结果
	 */
	public function getTitle($category = 0, $catefory2 = 0, $page = 1) {
		$where ['CategoryID'] = array (
				'eq',
				intval ( $category ) 
		);
		if ($catefory2 > 0)
			$where ['CategoryID2'] = array (
					'eq',
					intval ( $catefory2 ) 
			);
		$data = $this->field ( 'ArticleID,Title,CONVERT(varchar(10),PublishDate,111) AS PublishDate,DATENAME(WEEKDAY,PublishDate) AS WeekDay,DepartmentName' )->join ( 'Department ON Articles.DepartmentID=Department.DepartmentID' )->where ( $where )->page ( $page, C ( 'PASSAGE_LEN' ) )->order ( 'PublishDate DESC' )->select ();
		$result = array ();
		foreach ( $data as &$val ) {
			$result [$val ['publishdate'] . ' ' . $val ['weekday']] [] = array (
					'id' => $val ['articleid'],
					't' => $val ['title'],
					'd' => $val ['departmentname'] 
			);
		}
		return $result;
	}
	
	/**
	 * 搜索文章
	 *
	 * @param string $keyword 搜索关键词
	 * @param int $searchtype 搜索类型
	 * @param string $department 部门
	 * @param int $category 分类
	 * @param string $date_from 日期开始
	 * @param string $date_to 日期截止
	 * @param int $page 页码
	 * @return array 搜索结果
	 */
	public function search($keyword, $search_type, $department = 0, $category = 0, $date_from, $date_to, $page = 1) {
		switch ($search_type) {
			case 0 : // 标题搜索
				$where ['Title'] = array (
						'LIKE',
						'%' . $keyword . '%' 
				);
				break;
			case 1 : // 内容搜索
				$where ['Content'] = array (
						'LIKE',
						'%' . $keyword . '%' 
				);
				break;
			case 2 : // 全文搜索
				$where ['Title'] = array (
						'LIKE',
						'%' . $keyword . '%' 
				);
				$where ['Content'] = array (
						'LIKE',
						'%' . $keyword . '%' 
				);
				break;
			default :
				return false;
		}
		if ($department > 0)
			$where ['Articles.DepartmentID'] = array (
					'eq',
					intval ( $department ) 
			);
		if ($category > 0)
			$where ['Articles.CategoryID'] = array (
					'eq',
					intval ( $category ) 
			);
		if ($date_from != '')
			$where ['PublishDate'] [] = array (
					'gt',
					$date_from 
			);
		if ($date_to != '')
			$where ['PublishDate'] [] = array (
					'lt',
					$date_to 
			);
		return $this->field ( 'ArticleID,Title,CONVERT(varchar(10),PublishDate,111) AS PublishDate,DATENAME(WEEKDAY,PublishDate) AS WeekDay,DepartmentName' )->join ( 'Department ON Articles.DepartmentID=Department.DepartmentID' )->order ( 'PublishDate DESC' )->page ( $page, C ( 'PASSAGE_LEN' ) )->select ();
	}
	
	/**
	 * 获取热点新闻，未调用
	 *
	 * @param int $category 分类ID
	 * @return array 该分类的新闻
	 */
	public function getHot($category = 0) {
		$where ['PublishDate'] = array (
				'gt',
				'DATEADD(DAY,-30,GETDATE()' 
		);
		if ($category > 0)
			$where ['CategoryID'] = array (
					'eq',
					intval ( $category ) 
			);
		return $this->field ( 'ArticleID,Title,CONVERT(varchar(10),PublishDate,111) AS PublishDate,DATENAME(WEEKDAY,PublishDate) AS WeekDay,DepartmentName' )->join ( 'Department ON Articles.DepartmentID=Department.DepartmentID' )->order ( 'ViewCount DESC,PublishDate DESC' )->limit ( C ( 'PASSAGE_LEN' ) )->select ();
	}
}
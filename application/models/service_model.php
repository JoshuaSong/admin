<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	
	function get_list_home()
	{
		
		$this->db->order_by('list_id', 'RANDOM');
		$this->db->limit(5);
		$query = $this->db->get('list');

		$result = $query->result_array();
		
		return $result;
	}
	
			
	function get_list($category_id)
	{
		
		if($category_id != 'undefined'){
			$this->db->where('list_category_id', $category_id);
		}
		
		$query = $this->db->get('list');
		$result = $query->result_array();
		
		return $result;
	}

	
	function get_category()
	{
		$this->db->select('category.category_id, category.category_name, category.category_desc, category.category_image, COUNT(list_category_id) AS count');
        $this->db->from('category');
        $this->db->order_by('count', 'desc');

		$this->db->join('list', 'category.category_id = list.list_category_id','left');
        $this->db->group_by('category.category_name');
		 
		$query = $this->db->get();
		
		$result = $query->result_array();
		
		return $result;
	}


	function get_detail($filter)
	{
		if($filter != 'undefined'){
			$this->db->where('list_id', $filter);
		}

		$this->db->select('*');
        $this->db->from('list');
		$this->db->join('category', 'list.list_category_id =  category.category_id','left');
		
		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}

	function get_bookmark($id)
	{
		
		if($id != 'undefined'){
			$this->db->where('list_id', $id);
		}
		
		$this->db->select('list_id,list_name,list_image,list_cook_time');
		$query = $this->db->get('list');
		$result = $query->result_array();
		
		return $result;
	}
}
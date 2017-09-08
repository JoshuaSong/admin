<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get($category)
	{
		if($category != 'undefined'){
			$this->db->where('list_category_id', $category);
		}

		$query = $this->db->get('list');
		$result = $query->result_array();
		
		return $result;
	}

	function category()
	{
		$this->db->select('category.category_id, category.category_name, COUNT(list_category_id) AS count');
        $this->db->from('category');
        $this->db->order_by('count', 'desc');

		$this->db->join('list', 'category.category_id = list.list_category_id','left');
        $this->db->group_by('category.category_name');
		 
		$query = $this->db->get();
		
		$result = $query->result_array();
		
		return $result;
	}
	function channels()
	{
		$this->db->select('c_id, channel_title, COUNT(program_list.channel_id) AS count');
        $this->db->from('channels');
        $this->db->order_by('c_id');

		$this->db->join('program_list', 'channels.c_id = program_list.channel_id','left');
        $this->db->group_by('channels.channel_title');
		 
		$query = $this->db->get();
		
		$result = $query->result_array();
		
		return $result;
	}
}
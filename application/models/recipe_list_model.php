<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipe_list_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/*
	Get category
	*/
	function category()
	{

		$query = $this->db->get("category");
		$result = $query->result_array();
		
		return $result;
	}
	
	/*
	Action insert or update
	*/
	function insert($data,$data_id)
	{
		if ($data_id == '')
		{
			$result = $this->db->insert('list',$data);
			
			return $result;
			
		}else{
		
			$this->db->where('list_id', $data_id);
			$result = $this->db->update('list',$data);
		
			return $result;
			
			}	
		}
		
	
	/*
	Remove 
	*/
	function remove($data_id)
	{
		
	 	return $this->db->delete('list', array('list_id' => $data_id));
				
	}
	
	
	
}
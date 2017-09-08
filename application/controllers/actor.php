<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actor extends CI_Controller
{
	
	public function index()
	{	

		$this->load->view('actor_view');
	}

	/*
	Get requst data from datatables.
	*/
	public function get()
	{
		// Get data category
		$result = $this->datatables->getData('actors', array('a_id','actor_name','actor_poster'), 'a_id');
		echo $result;
	}

	/*
	Get action handle insert and update data.
	*/	
	public function insert()
	{	
	$insert_id = $this->input->post('channel_id');

		$data = array();	
		$data['actor_name']  = $this->input->post('actor_name');
		$data['actor_poster']  =$this->input->post('imageurl');

		if(!$insert_id)
		{
			$result=$this->db->insert('actors',$data);
			if($result)
				echo "Data insert was successful!";
			else
				echo "Data insert not success!";
		}
		else
			{
				$this->db->where('a_id', $insert_id);
			$result = $this->db->update('actors',$data);
			if($result)
				echo "Data update was successful!";
			else
				echo "Data update was successful!";
			}
	}
	
	/*
	Get action handle remove data.
	*/	
	public function remove()
	{
		$data_id = $this->input->post('remove_channel_id');
		
		$result=$this->db->delete('actors', array('a_id' => $data_id));
		if($result)
		echo "Data remove was successful!";
		else
		echo "Data remove was successful!";
		
	}
			
	
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CI_Controller
{
	
	public function index()
	{	

		$this->load->view('channel_view');
	}

	/*
	Get requst data from datatables.
	*/
	public function get()
	{
		// Get data category
		$result = $this->datatables->getData('channels', array('c_id','channel_title','channel_poster','order_id'), 'c_id');
		echo $result;
	}
	
	public function test()
	{
		// Get data category
	//	$result = $this->datatables->getData('channels', array('c_id','channel_title','channel_poster'), 'c_id','','',array('c_id','10'));
	//	echo $result;
	}
	

	/*
	Get action handle insert and update data.
	*/	
	public function insert()
	{	
	$insert_id = $this->input->post('channel_id');

		$data = array();	
		$data['channel_poster']  = $this->input->post('channel_poster');
		$data['channel_title']  = $this->input->post('channel_title');
		$data['order_id']  = $this->input->post('channel_order_id');

		if(!$insert_id)
		{
			$result=$this->db->insert('channels',$data);
			if($result)
				echo "Data insert was successful!";
			else
				echo "Data insert not success!";
		}
		else
			{
				$this->db->where('c_id', $insert_id);
			$result = $this->db->update('channels',$data);
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
		
		$result=$this->db->delete('channels', array('c_id' => $data_id));
		if($result)
		echo "Data remove was successful!";
		else
		echo "Data remove was successful!";
		
	}
			
	
}

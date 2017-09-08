<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller
{

	public function index()
	{	

		
		$this->load->view('comment_view');
	}
	
	public function get()
	{

	//	$result = $this->datatables->getData('comments', array('cm_id','user_id','user_name','channel_title','contents','create_time','status'), 
	//	'cm_id',array('channels','channels.c_id=comments.channel_id','inner'));
	$result = $this->datatables->getData('comments', array('cm_id','user_id','user_name','contents','create_time','status'),'cm_id');
	
		echo $result;
		
	}
	public function insert()
	{	
	$insert_id = $this->input->post('channel_id');

		$data = array();	
		$data['contents']  = $this->input->post('channel_title');

		
				$this->db->where('cm_id', $insert_id);
			$result = $this->db->update('comments',$data);
			if($result)
				echo "Data update was successful!";
			else
				echo "Data update was unsuccessful!";
			}
	
			
	
}

/* End of file list_location.php */
/* Location: ./application/controller/list_location.php */
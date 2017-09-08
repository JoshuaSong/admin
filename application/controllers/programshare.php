<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programshare extends CI_Controller
{

	public function index()
	{	

		
		$this->load->view('programshare_view');
	}
	
	public function get()
	{

		$result = $this->datatables->getData('program_share', array('ps_id','ps_user_id','program_title','share_with','touch_time'), 
		'ps_id',array('program_list','program_list.p_id = program_share.program_id','inner'));
		echo $result;
		
	}
	
			
	
}

/* End of file list_location.php */
/* Location: ./application/controller/list_location.php */
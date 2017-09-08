<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Programtouch extends CI_Controller
{

	public function index()
	{	

		
		$this->load->view('programtouch_view');
	}
	
	public function get()
	{

		$result = $this->datatables->getData('program_touch', array('pt_id','pt_user_id','program_title','touch_time'), 
		'pt_id',array('program_list','program_list.p_id = program_touch.program_id','inner'));
		echo $result;
		
	}
	
			
	
}

/* End of file list_location.php */
/* Location: ./application/controller/list_location.php */
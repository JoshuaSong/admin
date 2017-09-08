<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitetouch extends CI_Controller
{

	public function index()
	{	

		
		$this->load->view('sitetouch_view');
	}
	
	public function get()
	{

		$result = $this->datatables->getData('users_login', array('id','user_id','user_name','ip','country','state','city','last_login','user_agent','program_title'), 
		'id',array('program_list','program_list.p_id = users_login.program_id','inner'));
		echo $result;
		
	}
	
			
	
}

/* End of file list_location.php */
/* Location: ./application/controller/list_location.php */
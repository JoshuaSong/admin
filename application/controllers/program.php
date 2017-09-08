<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Program extends CI_Controller
{

	public function index()
	{	

		
		$this->load->view('program_view');
	}
	
	public function get()
	{

		$result = $this->datatables->getData('program_list', array('p_id','channel_title','program_title','actor_name','program_url','program_length','program_date','c_id'), 
		'p_id',array('channels','program_list.channel_id = channels.c_id','inner'),array('actors','program_list.program_actor_id = actors.a_id','inner'));
		echo $result;
		
	}
		public function get4timeline()
	{

		$result = $this->datatables->getData('program_list', array('p_id','program_date','program_title','program_length'), 
		'p_id',array('channels','program_list.channel_id = channels.c_id','inner'));
		echo $result;
		
	}
	
	
	public function get_channel()
	{
		$this->load->model('location_list_model');
		//$category = $this->location_list_model->category();
		$query = $this->db->get("channels");
		$result = $query->result_array();
		echo json_encode($result);
	}	
	public function get_actor()
	{
		$query = $this->db->get("actors");
		$result = $query->result_array();
		echo json_encode($result);
	}

	public function insert()
	{
	  
		
		$data_id = $this->input->post('list_id');

		$data = array();	
		//$data['list_name']  = $this->input->post('list_name');
		$data['channel_id']  = $this->input->post('list_category_id');
		$data['program_title']  = $this->input->post('list_cook_time');
		$data['program_subtitle']  = $this->input->post('list_summary');
		$data['program_url']  = $this->input->post('list_image');
		$data['program_length']  = $this->input->post('list_length');
		$data['program_date']  = $this->input->post('datepicker');
		$data['program_actor_id']  = $this->input->post('list_actor');
		
		
	//	$this->load->model('recipe_list_model');
	//	$result = $this->recipe_list_model->insert($data,$data_id);
		
		// Cek data insert or data update
		if(!$data_id)
		{
		$result = $this->db->insert('program_list',$data);
			if($result)
				echo "Data insert was successful!";
			else
				echo "Data insert not success!";
				}
		else
			{
				$this->db->where('p_id', $data_id);
			$result = $this->db->update('program_list',$data);
			if($result)
				echo "Data update was successful!";
			else
				echo "Data update was successful!";
			}
	}

	public function remove()
	{
		$data_id = $this->input->post('remove_list_id');
		
	$result=$this->db->delete('program_list', array('p_id' => $data_id));
		
		if($result)
			echo "Data remove was successful!";
		else
			echo "Data remove was successful!";
		
	}
	public function touched($pid)
	{
		$this->db->where('program_id',$pid);
		$query = $this->db->get("program_touch");
		
		echo 	$query->num_rows();
		
		
	}
			
	
}

/* End of file list_location.php */
/* Location: ./application/controller/list_location.php */
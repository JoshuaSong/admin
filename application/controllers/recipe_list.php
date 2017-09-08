<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recipe_list extends CI_Controller
{

	public function index()
	{	

		
		$this->load->view('recipe_list');
	}
	
	public function get()
	{

		$result = $this->datatables->getData('list', array('list_name','category_name','list_cook_time','list_summary','list_image','list_ingredients','list_instruction','list_category_id','list_id'), 'list_id',array('category','list.list_category_id = category.category_id','inner'));
		echo $result;
		
	}
	
	public function get_category()
	{
		$this->load->model('location_list_model');
		$category = $this->location_list_model->category();
		
		echo json_encode($category);
	}	

	public function insert()
	{
	   $config['path']   = './upload/images/';
	   $config['format'] =	array("jpg", "png", "gif", "bmp", "jpeg");
	   $config['size']   = '1024';
	   
	   $this->load->library('ajaxupload');
	   $this->ajaxupload->getUpload($config,"list_image");

		
		$query = $this->ajaxupload->query();
		
		$data_id = $this->input->post('list_id');

		$data = array();	
		$data['list_name']  = $this->input->post('list_name');
		$data['list_category_id']  = $this->input->post('list_category_id');
		$data['list_cook_time']  = $this->input->post('list_cook_time');
		$data['list_summary']  = $this->input->post('list_summary');
		$data['list_ingredients']  = $this->input->post('list_ingredients');
		$data['list_instruction']  = $this->input->post('list_instruction');
		
		if($query['file_name'] != ''){
			$data['list_image'] = $query['file_name'];
		}	
		
		$this->load->model('recipe_list_model');
		$result = $this->recipe_list_model->insert($data,$data_id);
		
		// Cek data insert or data update
		if(!$data_id)
			if($result)
				echo "Data insert was successful!";
			else
				echo "Data insert not success!";
		else
			if($result)
				echo "Data update was successful!";
			else
				echo "Data update was successful!";
	}

	public function remove()
	{
		$data_id = $this->input->post('remove_list_id');
		
		$this->load->model('recipe_list_model');
		$result = $this->recipe_list_model->remove($data_id);
		
		if($result)
			echo "Data remove was successful!";
		else
			echo "Data remove was successful!";
		
	}
			
	
}

/* End of file list_location.php */
/* Location: ./application/controller/list_location.php */
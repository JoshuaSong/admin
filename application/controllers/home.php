<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
			$this->load->view('home');
	}

	public function get_marker()
	{
		$category = $this->input->get('category');
		
		$this->load->model('home_model');
		$marker = $this->home_model->get($category);
		
		echo json_encode($marker);
	}

	public function get_category()
	{
		$this->load->model('home_model');
		$category = $this->home_model->category();
		
		echo json_encode($category);
	}
	public function get_channels()
	{
		$this->load->model('home_model');
		$channels = $this->home_model->channels();
		
		echo json_encode($channels);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
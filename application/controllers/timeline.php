<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeline extends CI_Controller {

	public function index()
	{
			$this->load->view('timeline_view');
	}
	public function get()
	{
			$this->db->where('start_time <',"2015-03-03 00:15:10");
		$this->db->order_by('start_time','desc');		
		//$this->db->or_where("start_m",$m);
		// $this->db->join('program_list', 'program_list.p_id = timeline.program_id');	
		 $query = $this->db->get('timeline_temp');
		 if ($query->num_rows()>0)
		 {
		 	$row = $query->result_array();
		 echo  '('.json_encode( $row ).');';
		 }
		
	}
	public function getfirst()
	{
		 $t = new DateTime("2015-03-03 00:01:00");

	
	 
		$this->db->where('start_time <',"2015-03-03 00:15:10");
		$this->db->order_by('start_time','desc');		
		//$this->db->or_where("start_m",$m);
		// $this->db->join('program_list', 'program_list.p_id = timeline.program_id');	
		 $query = $this->db->get('timeline_temp');
		 if ($query->num_rows()>0)
		 {
		 	$row = $query->first_row();
		    echo $row->start_time;
		 }
		
	}

	public function gettimeline()
	{
		
	$result = $this->datatables->getData('timeline_temp', array('start_time','program_title','program_length','program_id','tl_id'), 'tl_id',array('program_list','program_list.p_id =timeline_temp.program_id','inner'));
		echo $result;
		
	}
function addtl()
{
	$data=array();
	
	$d=strtotime($this->input->post('tl_time'));
	$data['start_time']=date('Y-m-d H:i:s', $d);
	$data['program_id']=$this->input->post('tl_pid');
	$result = $this->db->insert('timeline_temp',$data);
			if($result)
				echo "Data insert was successful!";
			else
				echo "Data insert not success!";
}
function repeat()
{
//	$d=strtotime($this->input->post('first_tl'))selected_tl   length_tl;
$r=intval($this->input->post('repeat_tl'));
	$sp=explode("#",$this->input->post('selected_tl'));
	$lp=explode("#",$this->input->post('length_tl'));
	$n=count($sp);
	$first=$this->input->post('first_tl');
	$newfirst=strtotime($first.' + '.$lp[$n-1].' minute');
	$first=date('Y-m-d H:i:s', $newfirst);
	for($j=1;$j<=$r;$j++)
	{
	for($i=1;$i<$n;$i++)
	{
	
	
	$data['start_time']=$first;
	$data['program_id']=$sp[$i];
	$this->db->insert('timeline_temp',$data);
	 $newfirst=strtotime($first.' + '.$lp[$i].' minute');
	 $first=date('Y-m-d H:i:s', $newfirst);
	
	}
	
	}
}
function clear()
{
	$result = $this->db->empty_table('timeline_temp');
			if($result)
				echo "Data insert was successful!";
			else
				echo "Data insert not success!";
	
}
function save2timeline()
{
	 $query =$this->db->get('timeline_temp');
	 
	 if ($query->num_rows()>0)
	 {
	 	$tamedate=$query->first_row()->start_time;
		$data1=date('Y-m-d',strtotime($tamedate));
		//$date2=date('Y-m-d',strtotime('+1 day', strtotime($tamedate)));
		$date7=date('Y-m-d',strtotime('-7 day', strtotime($tamedate)));
		$this->db->where('start_time <', $date7);
		$this->db->or_where('start_time >=', $tamedate);
		$this->db->delete('timeline'); 
		
		
		
	 	foreach ($query->result() as $row){
	 		$data=array();
			$data['start_time']=$row->start_time;
	        $data['program_id']=$row->program_id;
			$this->db->insert('timeline',$data);
	 	}
	 }
	$this->clear();

}
function time()
{
	//$newtimestamp = strtotime('2011-11-17 05:05:00 + 15 minute');
//echo date('Y-m-d H:i:s', $newtimestamp);
$first_date = strtotime('2015-4-6');
$second_date = strtotime('-7 day', $first_date);

echo 'First Date ' . date('Y-m-d', $first_date);
echo 'Next Date ' . date('Y-m-d', $second_date);
}
}

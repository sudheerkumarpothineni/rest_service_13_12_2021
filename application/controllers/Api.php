<?php
/**
 * 
 */
class Api extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->library('form_validation');
	}

	public function index(){
		$data = $this->api_model->fetch_all();
		echo json_encode($data);
	}

	public function insert(){
		// print_r($this->input->post());exit;
		$this->form_validation->set_rules('first_name','First Name','required');
		$this->form_validation->set_rules('last_name','last Name','required');
		if ($this->form_validation->run()) {
			$data=array('first_name'=>$this->input->post('first_name'),'last_name'=>$this->input->post('last_name'));
			$this->api_model->insert_api($data);
			$array=array('success'=>true,'msg'=>'Data Inserted');
		}
		else{
			$array=array('error'=>true,'first_name_error'=>form_error('first_name'),'last_name_error'=>form_error('last_name'));
		}
		echo json_encode($array);
	}

	public function fetch_single_user_data(){
		$origin = $this->input->post('origin');
		// echo $origin;exit;
		$result = $this->api_model->fetch_single_user_data($origin);
		echo json_encode($result[0]);
	}

	public function update(){
		// print_r($this->input->post());exit;
		$this->form_validation->set_rules('first_name','First Name','required');
		$this->form_validation->set_rules('last_name','last Name','required');
		if ($this->form_validation->run()) {
			$origin = $this->input->post('origin');
			$data=array('first_name'=>$this->input->post('first_name'),'last_name'=>$this->input->post('last_name'));
			$this->api_model->update_api($data,$origin);
			$array=array('success'=>true,'msg'=>'Data Updated');
		}
		else{
			$array=array('error'=>true,'first_name_error'=>form_error('first_name'),'last_name_error'=>form_error('last_name'));
		}
		echo json_encode($array);
	}

	public function delete(){
		$origin = $this->input->post('origin');
		// echo $origin;exit;
		$result = $this->api_model->delete_api($origin);
		// print_r($result);exit;
		if ($result) {
			$array=array('success'=>true,'msg'=>'Deleted');
		}
		else{
			$array=array('error'=>true);
		}
		echo json_encode($array);
	}
}
?>
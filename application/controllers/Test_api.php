<?php
/**
 * 
 */
class Test_api extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->config->load('api');
		$this->url = $this->config->item('api_base_url');
		$this->load->library('api');
	}

	public function index(){
		$this->load->view('api_view');
	}

	public function get_api_url($type){
		switch ($type) {
			case 'fetch_all':
				return $this->url;
				break;
			case 'Insert':
				return $this->url.'/insert';
				break;
			case 'fetch_single_user_data':
				return $this->url.'/fetch_single_user_data';
				break;
			case 'Update':
				return $this->url.'/update';
				break;
			case 'Delete':
				return $this->url.'/delete';
				break;
			default:
				return $this->url;
				break;
		}
	}

	public function action(){
		error_reporting(E_ALL & ~E_NOTICE);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		if ($this->input->post('data_action')) {
			$data_action = $this->input->post('data_action');

			// Fetch All	
			if ($data_action == 'fetch_all') {
				$api_url = $this->get_api_url($data_action);
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($client);
				curl_close($client);
				$result = json_decode($response);
				$output = '';
				if (count($result) > 0) {
					foreach ($result as $row) {
						$output.='
								<tr>
									<td>'.$row->first_name.'</td>
									<td>'.$row->last_name.'</td>
									<td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->origin.'">Edit</button>
									<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->origin.'">Delete</button></td></td>
								</tr>
						';
					}
				}
				else{
					$output.= '
						<tr>
							<td colspan="4" align="center">No data found</td>
						</tr>
					';
				}
				echo $output;
			}

			// Insert
			if ($data_action == 'Insert') {
				$form_data = array(
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name')
				);
				$api_url = $this->get_api_url($data_action);
				$this->api->get_json_response($api_url,$form_data);
			}

			// Fetch Single User Data
			if ($data_action == 'fetch_single_user_data') {
				$form_data = array('origin' => $this->input->post('origin'));
				$api_url = $this->get_api_url($data_action);
				$this->api->get_json_response($api_url,$form_data);
			}

			// Update
			if ($data_action == 'Update') {
				$form_data = array(
							'origin' => $this->input->post('origin'),
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name')
				);
				$api_url = $this->get_api_url($data_action);
				$this->api->get_json_response($api_url,$form_data);
			}

			// Delete
			if ($data_action == 'Delete') {
				$form_data = array('origin' => $this->input->post('origin'));
				$api_url = $this->get_api_url($data_action);
				$this->api->get_json_response($api_url,$form_data);
			}
		}
	}
}
?>
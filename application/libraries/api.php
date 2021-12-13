<?php
/**
 * 
 */
class Api
{
	protected $CI;
	
	public function __construct()
	{
		$this->CI = & get_instance();
	}

	public function get_json_response($url,$form_data=''){

		$client = curl_init($url);

		curl_setopt($client, CURLOPT_POST, true);

		curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

		curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($client);

		curl_close($client);

		echo $response;
	}
}
?>
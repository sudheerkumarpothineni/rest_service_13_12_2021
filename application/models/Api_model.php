<?php
/**
 * 
 */
class Api_model extends CI_Model
{
	public function fetch_all(){
		// echo "string";exit;
		$this->db->order_by('origin','DESC');
		return $this->db->get('tbl_users')->result_array();
	}

	public function insert_api($data){
		$this->db->insert('tbl_users',$data);
	}

	public function fetch_single_user_data($origin){
		$this->db->where('origin',$origin);
		return $this->db->get('tbl_users')->result_array();
	}

	public function update_api($data,$origin){
		$this->db->where('origin',$origin);
		$this->db->update('tbl_users',$data);
	}

	public function delete_api($origin){
		$this->db->where('origin',$origin);
		return $this->db->delete('tbl_users');
	}
	
}
?>
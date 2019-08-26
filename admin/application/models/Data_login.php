<?php
class Data_login extends CI_Model{
	
	function cek($table,$where){
		return $this->db->get_where($table,$where);
	}
}
?>
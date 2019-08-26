<?php
class M_keuangan extends CI_Model{


	function data_keuangan(){ 
	return $this->db->get_where('tb_pj_keuangan',array('status'=> 'Aktif'));
	}
	function input($data,$table){
		$this->db->insert($table,$data);
	}
	
}
?>
<?php
class M_mitra extends CI_Model{


	function data_mitra(){ 
	return $this->db->get_where('tb_suplier',array('status'=> 'Aktif'));
	}
	function input($data,$table){
		$this->db->insert($table,$data);
	}
}
?>
<?php
class M_admin extends CI_Model{


	function data_admin(){
	return $this->db->get_where('tb_admin',array('status'=> 'Aktif'));
	}
	function input($data,$table){
		$this->db->insert($table,$data);
	}
	function jumlah_terjual(){
    $this->db->select('id_produk,harga,kategori,nama,stok');
    $this->db->from('tb_produk');
    $query = $this->db->get();
		return $query->result();
  }
	function view_toko_admin($id_admin){
		$this->db->select('tb_brand.id_brand,tb_brand.id_admin,tb_brand.id_supplier,tb_brand.nama AS brand,tb_brand.kategori,tb_admin.id_admin,tb_admin.nama AS admin_toko');
		$this->db->from('tb_brand');
		$this->db->join('tb_admin','tb_brand.id_admin = tb_admin.id_admin');
		$this->db->where('tb_brand.id_admin',$id_admin);
		$this->db->where('tb_brand.id_supplier IS NULL');
		$hasil = $this->db->get();
		return $hasil->result();
	}
	function daftar_mitra(){
		$this->db->select('*');
		$this->db->from('tb_suplier');
		$hasil = $this->db->get();
		return $hasil->result();
	}
	function toko_admin($id_admin){
		$this->db->select('tb_brand.id_brand,tb_brand.id_admin,tb_brand.id_supplier,tb_brand.nama AS brand,tb_admin.id_admin,tb_admin.nama AS admin_toko');
		$this->db->from('tb_brand');
		$this->db->join('tb_admin','tb_brand.id_admin = tb_admin.id_admin');
		$this->db->where('tb_brand.id_admin',$id_admin);
		$this->db->where('tb_brand.id_supplier IS NULL');
		$hasil = $this->db->get();

		return $hasil->result();
	}
	function reload_daftar_toko(){
		$this->db->select('tb_brand.id_brand,tb_brand.id_admin as adm,tb_brand.id_supplier,tb_brand.nama AS brand,tb_brand.kategori,tb_admin.id_admin,tb_admin.nama AS admin_toko');
		$this->db->from('tb_brand');
		$this->db->join('tb_admin','tb_brand.id_admin = tb_admin.id_admin');
		$this->db->where('tb_brand.id_supplier IS NULL');

		$hasil = $this->db->get();
		return $hasil->result();
	}
	function add_mitra($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	function brand_bermitra($id_admin){
		$this->db->select('tb_brand.id_brand,tb_brand.id_admin,tb_brand.id_supplier,tb_brand.nama AS brand,tb_brand.kategori,tb_admin.id_admin,tb_admin.nama AS admin_toko');
		$this->db->from('tb_brand');
		$this->db->join('tb_admin','tb_brand.id_admin = tb_admin.id_admin');
		$this->db->where('tb_brand.id_admin',$id_admin);
		$this->db->where('tb_brand.id_supplier IS NOT NULL');
		$hasil = $this->db->get();

		return $hasil->result();
	}

}
?>

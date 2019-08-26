<?php
class M_keuangan_ extends CI_Model{


	function data_payment($table,$where){
	return $this->db->get_where($where,$table);
	}
	function data_ditolak($table,$ditolak){
		return $this->db->get_where($ditolak,$table);
	}
	function data_disetujui($table,$disetujui){
		return $this->db->get_where($disetujui,$table);
	}
	function data_request_cancel(){
		$id_pj_keuangan = $this->session->userdata('id_pj_keuangan');
		$this->db->select('*');
		$this->db->select('tb_transaksi.id_produk as produk_cart,tb_transaksi.status as st');
		$this->db->from('tb_transaksi');
		$this->db->join('tb_produk', 'tb_transaksi.id_produk = tb_produk.id_produk');
		$this->db->join('tb_pembayaran', 'tb_transaksi.id_transaksi = tb_pembayaran.id_transaksi');
		$this->db->where('id_pj_keuangan', $id_pj_keuangan);
		$this->db->where("(tb_pembayaran.status='Dibatalkan Pembeli' OR tb_transaksi.status='Proses Refound')", NULL, FALSE);
		$query = $this->db->get();
		return $query;
	}
	function tolak_setujui($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	function konfirmasi_ke_pembeli($id_trx,$isi,$table){
		$this->db->where($id_trx);
		$this->db->update($table,$isi);
	}
	function accept_refound($id_trx,$isi,$table){
		$this->db->where($id_trx);
		$this->db->update($table,$isi);
	}
	function acc($id_trx1,$isi1,$table){
		$this->db->where($id_trx1);
		$this->db->update($table,$isi1);
	}
	function refound_proses($table,$id_ref){
		return $this->db->get_where($id_ref,$table);
	}
	function detail_transfer($id_transaksi){
		$this->db->select('tb_pembayaran.id_pembayaran,tb_pembayaran.id_transaksi,tb_pembayaran.nominal,tb_pembayaran.bukti_transfer');
		$this->db->select('tb_admin.id_admin,tb_admin.nama AS admin_toko');
		$this->db->select('tb_suplier.id_supplier,tb_suplier.nama AS mitra');
		$this->db->select('tb_brand.id_brand,tb_brand.nama AS toko');
		$this->db->select('tb_produk.id_produk,tb_produk.nama AS produk');
		$this->db->select('tb_pembeli.id_pembeli,tb_pembeli.username AS pembeli');
		$this->db->select('tb_transaksi.id_produk as produk_cart,tb_transaksi.id_transaksi,tb_transaksi.nama_dropshiper,tb_transaksi.no_hp_dropshiper,tb_transaksi.nama_penerima,
		tb_transaksi.alamat_penerima,tb_transaksi.no_tlp_penerima,tb_transaksi.jasa_kirim,tb_transaksi.service,tb_transaksi.ongkos_kirim,tb_transaksi.jumlah_beli,
		tb_transaksi.jumlah_biaya_produk,tb_transaksi.produk_dan_ongkir,tb_transaksi.jam_transaksi,tb_transaksi.resi,tb_transaksi.status,tb_transaksi.dari_cart,tb_transaksi.kode_booking');
		$this->db->from('tb_pembayaran');
		$this->db->join('tb_transaksi','tb_pembayaran.id_transaksi=tb_transaksi.id_transaksi');
		$this->db->join('tb_admin' , 'tb_transaksi.id_admin = tb_admin.id_admin');
		$this->db->join('tb_suplier' , 'tb_transaksi.id_supplier = tb_suplier.id_supplier');
		$this->db->join('tb_brand' , 'tb_transaksi.id_brand = tb_brand.id_brand');
		$this->db->join('tb_produk' , 'tb_transaksi.id_produk= tb_produk.id_produk');
		$this->db->join('tb_pembeli' , 'tb_transaksi.id_pembeli = tb_pembeli.id_pembeli');
		$this->db->where('tb_pembayaran.id_transaksi',$id_transaksi);
		$hasil = $this->db->get();
		return $hasil->result();

	}


}
?>

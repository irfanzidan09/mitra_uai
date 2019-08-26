<?php
class Keuangan_ extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login/keuangan"));
		}else if($this->session->userdata('level') != "pj_keuangan"){
			redirect(base_url("login/logout_keuangan"));
		}
		$this->load->model(array('m_keuangan_'));

	}
	function index(){
		//$data['admins'] = $this->m_admin->data_admin();
        $this->load->view('keuangan/dashboard');
		}
	function payment(){
		$where = "status IS NULL";
		$data['payment'] = $this->m_keuangan_->data_payment($where,'tb_pembayaran')->result();
		$di_tolak ="Di tolak";
		$di_setujui ="Di Setujui";
		$ditolak = array('status'=> $di_tolak);
		$data['ditolak'] = $this->m_keuangan_->data_ditolak($ditolak,'tb_pembayaran')->result();
		$disetujui = array('status'=> $di_setujui);
		$data['disetujui'] = $this->m_keuangan_->data_disetujui($disetujui,'tb_pembayaran')->result();
		$data['page'] = "admin/tambah";
		$this->load->view('keuangan/h');
		$this->load->view('keuangan/header_panel');
		$this->load->view('keuangan/side_bar');
		$this->load->view('keuangan/v_payment',$data);
		
	}
	function tolak($id_pembayaran){
		$pj_keuangan = $this->session->userdata('id_pj_keuangan');
		$status = "Di Tolak";
		$where = array('id_pembayaran'=>$id_pembayaran);
		$data = array('status'=>$status,'id_pj_keuangan'=>$pj_keuangan);
		$this->m_keuangan_->tolak_setujui($where,$data,'tb_pembayaran');
		$data['payment'] = $this->m_keuangan_->data_payment($where,'tb_pembayaran')->result();
		foreach ($data['payment'] as $xx) {
			$id_tr = $xx->id_transaksi;
		}
		$dikonfirm = "Ditolak";
		$id_trx=array('id_transaksi'=>$id_tr);
		$isi = array('status'=>$dikonfirm,'catatan_ditolak'=>'Upload Ulang Resi');
		$this->m_keuangan_->konfirmasi_ke_pembeli($id_trx,$isi,'tb_transaksi');
		redirect('keuangan_/payment');
	}
	function setujui($id_pembayaran){
		$pj_keuangan = $this->session->userdata('id_pj_keuangan');
		$status = "Di Setujui";
		$where = array('id_pembayaran'=>$id_pembayaran);
		$data = array('status'=>$status,'id_pj_keuangan'=>$pj_keuangan);
		$this->m_keuangan_->tolak_setujui($where,$data,'tb_pembayaran');
		$data['payment'] = $this->m_keuangan_->data_payment($where,'tb_pembayaran')->result();
		foreach ($data['payment'] as $xx) {
			$id_tr = $xx->id_transaksi;
		}
		$dikonfirm = "Dikonfirmasi";
		$id_trx=array('id_transaksi'=>$id_tr);
		$isi = array('status'=>$dikonfirm);
		$this->m_keuangan_->konfirmasi_ke_pembeli($id_trx,$isi,'tb_transaksi');
		//$data = array('status'=>$dikonfirm,'id_');
		redirect('keuangan_/payment');
	}
	function refound(){

		$data['request_refound'] = $this->m_keuangan_->data_request_cancel()->result();
		$id_ref = array('status'=>'Refound Selesai Oleh Admin');
		$data['proses_refound'] = $this->m_keuangan_->refound_proses($id_ref,'tb_pembayaran')->result();
		$this->load->view('keuangan/v_refound',$data);
	}
	function accept_refound($id_transaksi){
		$id_trx = array('id_transaksi'=>$id_transaksi);
		$isi = array('status'=>'Refound Selesai Oleh Admin');
		$this->m_keuangan_->accept_refound($id_trx,$isi,'tb_pembayaran');
		$id_trx1 = array('id_transaksi'=>$id_transaksi);
		$isi1 = array('status'=>'Refound Selesai');
		$this->m_keuangan_->acc($id_trx1,$isi1,'tb_transaksi');
		redirect('keuangan_/refound');
	}
	function ajax_detail_transfer(){
		$id_transaksi = $this->input->get('id_transaksi');
		$data = $this->m_keuangan_->detail_transfer($id_transaksi);
		echo json_encode($data);
	}

}
?>

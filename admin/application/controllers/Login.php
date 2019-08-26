<?php
class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('data_login');


	}

	function index(){
		$this->load->view('super_admin/super/login');
	}
	function admin(){
		$this->load->view('admin_toko/v_login_admin');
	}
	function mitra(){
		$this->load->view('mitra/v_login_mitra');
	}
	function pembeli(){
		$this->load->view('pembeli/v_login_pembeli');
	}
	function keuangan(){
		$this->load->view('keuangan/v_login');
	}

	function super_admin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
			$where = array(
			'username' => $username,
			'password' => md5($password)
			);
				$cek = $this->data_login->cek("tb_super_admin",$where)->num_rows();
						if($cek > 0){
							$data_session = array(
								'nama' => $username,
								'level' =>"super admin",
								'status' => "login"
								);
							$this->session->set_userdata($data_session);
							redirect(base_url("admin/data"));
						}else{
							echo "<script type='text/javascript'>
               					alert ('Maaf Username Dan Password Anda Salah !');
      							</script>";
	  						$this->load->view('super_admin/super/login');
						}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
	function logout_admin(){
		$this->session->sess_destroy();
		redirect(base_url('login/admin'));
	}
	function logout_mitra(){
		$this->session->sess_destroy();
		redirect(base_url('login/mitra'));
	}
	function logout_pembeli(){
		$this->session->sess_destroy();
		redirect(base_url('login/pembeli'));
	}
	function logout_keuangan(){
		$this->session->sess_destroy();
		redirect(base_url('login/keuangan'));
	}
	function admin_toko(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$p = password_hash($password, PASSWORD_DEFAULT);
		$pwd =password_verify($password, $p);
			$where = array(
			'username' => $username
			);
				$cek = $this->data_login->cek("tb_admin",$where)->num_rows();
				$cek1 = $this->data_login->cek("tb_admin",$where)->result();
				$id_admin ="Tes";
				foreach ($cek1 as $a) {
					$id_admin = $a->id_admin;
				}
						if($cek > 0){
							$data_session = array(
								'id_admin' => $id_admin,
								'nama' => $username,
								'level' =>"admin_toko",
								'status' => "login"
								);
								if(password_verify($password, $p)){
									$this->session->set_userdata($data_session);
									redirect(base_url("admin_toko"));
								}else{
									echo "<script type='text/javascript'>
               					alert ('Password Anda Salah');
      							</script>";
	  								$this->load->view('admin_toko/v_login_admin');
								}

						}else{
							echo "<script type='text/javascript'>
               					alert ('Username anda belum terdaftar');
      							</script>";
	  						$this->load->view('admin_toko/v_login_admin');
						}
	}
	function mitra_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$p = password_hash($password, PASSWORD_DEFAULT);
		$pwd =password_verify($password, $p);
			$where = array(
			'username' => $username
			);
				$cek = $this->data_login->cek("tb_suplier",$where)->num_rows();
				$cek1 = $this->data_login->cek("tb_suplier",$where)->result();
				foreach ($cek1 as $key) {
					$id_mitra=$key->id_supplier;
				}
						if($cek > 0){
							$data_session = array(
								'id_mitra'=>$id_mitra,
								'nama' => $username,
								'level' =>"mitra",
								'status' => "login"
								);
								if(password_verify($password, $p)){
									$this->session->set_userdata($data_session);
									redirect(base_url("mitra_"));
								}else{
									echo "<script type='text/javascript'>
               					alert ('Password Anda Salah');
      							</script>";
	  								$this->load->view('mitra/v_login_mitra');
								}

						}else{
							echo "<script type='text/javascript'>
               					alert ('Username anda belum terdaftar');
      							</script>";
	  						$this->load->view('mitra/v_login_mitra');
						}
	}
	function pembeli_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$p = password_hash($password, PASSWORD_DEFAULT);
		$pwd =password_verify($password, $p);
			$where = array(
			'username' => $username
			);
				$cek = $this->data_login->cek("tb_pembeli",$where)->num_rows();
				$cek1 = $this->data_login->cek("tb_pembeli",$where)->result();
				$id_pembeli ="Tes";
				foreach ($cek1 as $a) {
					$id_pembeli = $a->id_pembeli;
					$alamat = $a->alamat;
				}
						if($cek > 0){
							$data_session = array(
								'id_pembeli'=>$id_pembeli,
								'nama' => $username,
								'level' =>"pembeli",
								'status' => "login",
								'alamat'=>$alamat
								);
								if(password_verify($password, $p)){
									$this->session->set_userdata($data_session);
									redirect(base_url("produk"));
								}else{
									echo "<script type='text/javascript'>
               					alert ('Password Anda Salah');
      							</script>";
	  								$this->load->view('pembeli/v_login_pembeli');
								}

						}else{
							echo "<script type='text/javascript'>
               					alert ('Username anda belum terdaftar');
      							</script>";
	  						$this->load->view('pembeli/v_login_pembeli');
						}
	}
	function keuangan_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$p = password_hash($password, PASSWORD_DEFAULT);
		$pwd =password_verify($password, $p);
			$where = array(
			'username' => $username
			);
				$cek = $this->data_login->cek("tb_pj_keuangan",$where)->num_rows();
				$cek1 = $this->data_login->cek("tb_pj_keuangan",$where)->result();
				$id_pj ="Tes";
				foreach ($cek1 as $a) {
					$id_pj = $a->id_pj_keuangan;
				}
						if($cek > 0){
							$data_session = array(
								'id_pj_keuangan'=> $id_pj,
								'nama' => $username,
								'level' =>"pj_keuangan",
								'status' => "login"
								);
								if(password_verify($password, $p)){
									$this->session->set_userdata($data_session);
									redirect(base_url("keuangan_/payment"));
								}else{
									echo "<script type='text/javascript'>
               					alert ('Password Anda Salah');
      							</script>";
	  								$this->load->view('keuangan/v_login');
								}

						}else{
							echo "<script type='text/javascript'>
               					alert ('Username anda belum terdaftar');
      							</script>";
	  						$this->load->view('keuangan/v_login');
						}
	}
}
?>

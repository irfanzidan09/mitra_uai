
<?php
class Keuangan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}else if($this->session->userdata('level') != "super admin"){
			redirect(base_url("login/logout"));
		}
		$this->load->model(array('m_keuangan'));
		
	}
	function index(){
		$data['page'] = "keuangan/data";
		$data['keuangan'] = $this->m_keuangan->data_keuangan();
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_data_keuangan',$data);
		}

	function data(){
		$data['keuangan'] = $this->m_keuangan->data_keuangan();
		$data['page'] = "keuangan/data";
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_data_keuangan',$data);

	}
	function tambah(){
		$data['page'] = "keuangan/tambah";
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_keuangan',$data);
	}
	//upload gambar
	public function upload(){
	    $config['upload_path'] = './gambar/';
	    $config['allowed_types'] = 'jpg|png|jpeg';
	    $config['max_size']  = '2048';
	    $config['remove_space'] = TRUE;
	  
	    $this->load->library('upload', $config); // Load konfigurasi uploadnya
	    if($this->upload->do_upload('input_gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
	      // Jika berhasil :
	      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
	      return $return;
	    }else{
	      // Jika gagal :
	      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
	      return $return;
	    }
  	}
	//end upload
	function input(){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');		 
		$p = $this->input->post('password');
		$password = password_hash($p, PASSWORD_DEFAULT);
		$tempat_tgl_lahir = $this->input->post('ttl');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$status='Aktif';
		$no_hp = $this->input->post('no_hp');
		$nama_ayah = $this->input->post('nama_ayah');
		$nama_ibu = $this->input->post('nama_ibu');
		$p_terakhir = $this->input->post('pendidikan');
		$alamat = $this->input->post('alamat');
		$stifin = $this->input->post('stifin');
		
		$data = array(
			'nama' 				=> $nama,
			'username'			=> $username,
			'password' 			=> $password,
			'tempat_tgl_lahir'	=> $tempat_tgl_lahir,
			'jenis_kelamin' 	=> $jenis_kelamin,
			'status' 			=> $status,
			'no_hp' 			=> $no_hp,
			'nama_ayah' 		=> $nama_ayah,
			'nama_ibu' 			=> $nama_ibu,
			'pendidikan_terakhir' 		=> $p_terakhir,
			'alamat' 			=> $alamat,

			'hasil_stifin' 			=> $stifin
			);
		$this->m_keuangan->input($data,'tb_pj_keuangan');
		redirect('/keuangan/data');
	}	
}
?>
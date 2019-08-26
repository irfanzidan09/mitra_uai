
<?php
class Admin extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}else if($this->session->userdata('level') != "super admin"){
			redirect(base_url("login/logout"));
		}
		$this->load->model(array('m_admin'));

	}
	function index(){
		$data['page'] = "admin/data";
		$data['admins'] = $this->m_admin->data_admin();
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_data_admin',$data);
		
		}

	function data(){
		$data['admins'] = $this->m_admin->data_admin();
        $data['page'] = "admin/data";
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_data_admin',$data);

	}
	function tambah(){
		$data['page'] = "admin/tambah";
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_add_admin',$data);
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
		$this->m_admin->input($data,'tb_admin');
		redirect('/admin/data');
	}
	function data_marketing(){
		$data['jumlah_terjual'] = $this->m_admin->jumlah_terjual();
        $data['page'] = "admin/data";
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_penjualan',$data);
	}
	function toko_admin(){
		$id_admin = $this->input->get('id_admin');
		$data = $this->m_admin->toko_admin($id_admin);
		echo json_encode($data);
	}
	function view_admin_toko($id_admin){
		$data['toko_admin'] = $this->m_admin->view_toko_admin($id_admin);
		$data['daftar_mitra'] = $this->m_admin->daftar_mitra();
		$data['brand_bermitra'] = $this->m_admin->brand_bermitra($id_admin);
		$data['page'] = "admin/view_admin_toko/".$id_admin;
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_toko_admin',$data);
	}
	function reload_daftar_toko(){

		$data = $this->m_admin->reload_daftar_toko();
		echo json_encode($data);
	}
	function add_mitra(){
		$id_brand = $this->input->post('id_brand');
		$id_supplier = $this->input->post('id_supplier');
		$data = array('id_supplier'=>$id_supplier);
		$where= array('id_brand'=>$id_brand);
		$data = $this->m_admin->add_mitra($where,$data,'tb_brand');
		echo json_encode($data);
	}

}
?>

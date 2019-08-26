
<?php
class Mitra extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}else if($this->session->userdata('level') != "super admin"){
			redirect(base_url("login/logout"));
		}
		$this->load->model(array('m_mitra'));
		//$this->load->library('rajaongkir');
	}
	function rajaongkir_get_provinsi(){

			 $curl = curl_init();

			 curl_setopt_array($curl, array(
				 CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
				 CURLOPT_RETURNTRANSFER => true,
				 CURLOPT_ENCODING => "",
				 CURLOPT_MAXREDIRS => 10,
				 CURLOPT_TIMEOUT => 30,
				 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				 CURLOPT_CUSTOMREQUEST => "GET",
				 CURLOPT_HTTPHEADER => array(
					 "key: 1d8c81ab964d11518ff6ca5dbd770808"
				 ),
			 ));

			 $response = curl_exec($curl);
			 $err = curl_error($curl);

			 curl_close($curl);

			 if ($err) {
				 echo "cURL Error #:" . $err;
			 } else {
				 //echo $response;
			 }

			 $obj = json_decode($response, true);
			 $select_prov = '<option value=0>- Pilih Provinsi -</option>';
			 for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
						$select_prov .= "<option value='".$obj['rajaongkir']['results'][$i]['province_id']."'>".$obj['rajaongkir']['results'][$i]['province']."</option>";
			 }

			 echo $select_prov;

	 }

	 function rajaongkir_get_kota(){

			 $id_province = $this->input->post('id_province',TRUE);

			 $curl = curl_init();

			 curl_setopt_array($curl, array(
				 CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=$id_province",
				 CURLOPT_RETURNTRANSFER => true,
				 CURLOPT_ENCODING => "",
				 CURLOPT_MAXREDIRS => 10,
				 CURLOPT_TIMEOUT => 30,
				 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				 CURLOPT_CUSTOMREQUEST => "GET",
				 CURLOPT_HTTPHEADER => array(
					 "key: 1d8c81ab964d11518ff6ca5dbd770808"
				 ),
			 ));

			 $response = curl_exec($curl);
			 $err = curl_error($curl);

			 curl_close($curl);

			 if ($err) {
				 echo "cURL Error #:" . $err;
			 } else {
				 //echo $response;
			 }

			 $obj = json_decode($response, true);
			 $select_kotkab = '<option value=0>- Pilih Kota / Kabupaten -</option>';
			 for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
						$select_kotkab .= "<option value='".$obj['rajaongkir']['results'][$i]['city_id']."'>".$obj['rajaongkir']['results'][$i]['type']." ".$obj['rajaongkir']['results'][$i]['city_name']."</option>";
			 }

			 echo $select_kotkab;

	 }
	 function rajaongkir_get_kecamatan(){

        $id_kota = $this->input->post('id_kota',TRUE);

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$id_kota",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 1d8c81ab964d11518ff6ca5dbd770808"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }

        $obj = json_decode($response, true);
        $select_kecamatan = '<option value=0>- Pilih Kecamatan -</option>';
        for($i=0; $i < count($obj['rajaongkir']['results']); $i++){
             $select_kecamatan .= "<option wil=".$obj['rajaongkir']['results'][$i]['subdistrict_name']." value='".$obj['rajaongkir']['results'][$i]['subdistrict_id']."'>Kec. ".$obj['rajaongkir']['results'][$i]['subdistrict_name']."</option>";
        }

        echo $select_kecamatan;

    }


	function index(){
		$data['page'] = "mitra/data";
		$data['mitras'] = $this->m_mitra->data_mitra();
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_data_mitra',$data);
		}


	function data(){
		$data['mitras'] = $this->m_mitra->data_mitra();
       	$data['page'] = "mitra/data";
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_data_mitra',$data);
	}
	function tambah(){
		$data['page'] = "mitra/tambah";
		$this->load->view('super_admin/super/h');
		$this->load->view('super_admin/super/header_panel');
		$this->load->view('super_admin/super/side_bar');
		$this->load->view('super_admin/super/v_mitra',$data);
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
	public function province(){
		$provinces = $this->rajaongkir->province(); // output json
		print_r($provinces);
	}
	function input(){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$p = $this->input->post('password');
		$password = password_hash($p, PASSWORD_DEFAULT);
		$alamat = $this->input->post('alamat');
		$wilayah = $this->input->post('nama_wilayah');
		$no_hp = $this->input->post('no_hp');
		$email = $this->input->post('email');
		$kategori = $this->input->post('kategori');
		$rekening = $this->input->post('rekening');
		$bank = $this->input->post('bank');
		$atas_nama = $this->input->post('atas_nama');
		$id_wilayah = $this->input->post('id_wilayah');
		$status = "Aktif";



		$data = array(
			'nama' 				=> $nama,
			'username'			=> $username,
			'password' 			=> $password,
			'alamat'	=> $alamat,
			'wilayah' 	=> $wilayah,
			'no_hp' 			=> $no_hp,
			'email' 			=> $email,
			'kategori_produk' 		=> $kategori,
			'rekening' 			=> $rekening,
			'bank' 		=> $bank,
			'atas_nama' 			=> $atas_nama,
			'status' 			=> $status,
			'id_wilayah'	=>$id_wilayah
			);
		$this->m_mitra->input($data,'tb_suplier');
		redirect('/mitra/data');
	}


}
?>

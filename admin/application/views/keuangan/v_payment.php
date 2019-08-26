<link rel="stylesheet" href="<?php echo base_url() ?>assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">
<div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Pj Keuangan</a></li>
        <li><a href="#">Pembayaran</a></li>
        
      </ol>

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">Data Pembayaran</h4>
          
        </div>
        <div class="panel-body">
        	<div class="row">
      
          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-inverse nav-justified">
            <li class="active"><a href="#popular10" data-toggle="tab" aria-expanded="true"><strong>Pembayaran Masuk</strong></a></li>
            <li class=""><a href="#recent10" data-toggle="tab" aria-expanded="false"><strong>Pembayaran Ditolak</strong></a></li>
            <li><a href="#comments10" data-toggle="tab"><strong>Pembayaran Terkonfirmasi</strong></a></li>
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20" id="tab">
            <div class="tab-pane active" id="popular10">
              <div class="table-responsive">
              	<table  class="table table-bordered table-striped-col" id="mydata">
              	 <thead>
	        <tr>
	          <th>Invoice</th>
	          <th>Tanggal</th>
	          <th>Pembeli</th>
	          <th>Brand</th>
	          <th>Admin</th>
	          <th>Sp</th>
	          <th>Nominal</th>
						<th>Bank</th>
						<th>Produk</td>

	        </tr>
	      </thead>
	      <tbody id="show_data1">
	        <?php

	        foreach ($payment as $a) {
	          $id_trx = $a->id_transaksi;
	         ?>
	        <tr>
	          <td class="id_transaksi" data_transaksi=<?php echo $a->id_transaksi ?> >INV/UAI-Mart/<?php echo $a->id_transaksi ?></td>
	          <?php
	            $query = $this->db->query("SELECT tb_pembayaran.id_transaksi,tb_pembayaran.tanggal_bayar,tb_pembayaran.nominal,
	                                      tb_transaksi.id_transaksi,tb_transaksi.id_admin,tb_transaksi.id_supplier,tb_transaksi.id_brand,tb_transaksi.id_produk,tb_transaksi.id_pembeli,tb_transaksi.dari_cart,
	                                      tb_admin.id_admin,tb_admin.nama AS admin_toko,
	                                      tb_suplier.id_supplier,tb_suplier.nama AS mitra,
	                                      tb_brand.id_brand,tb_brand.nama AS toko,
	                                      tb_produk.id_produk,tb_produk.nama AS produk,
	                                      tb_pembeli.id_pembeli,tb_pembeli.nama AS pembeli,
	                                      tb_transaksi.id_produk as produk_cart
	                                      FROM tb_pembayaran
	                                      JOIN tb_transaksi ON tb_pembayaran.id_transaksi=tb_transaksi.id_transaksi
	                                      JOIN tb_admin ON tb_transaksi.id_admin = tb_admin.id_admin
	                                      JOIN tb_suplier ON tb_transaksi.id_supplier = tb_suplier.id_supplier
	                                      JOIN tb_brand ON tb_transaksi.id_brand = tb_brand.id_brand
	                                      JOIN tb_produk ON tb_transaksi.id_produk= tb_produk.id_produk
	                                      JOIN tb_pembeli ON tb_transaksi.id_pembeli = tb_pembeli.id_pembeli
	                                      WHERE tb_pembayaran.id_transaksi ='$id_trx'");
	            $hasil= $query->result();
	            foreach ($hasil as $data) {
	              # code...

	           ?>
	           <td><?php echo $data->tanggal_bayar ?></td>
	           <td><?php echo $data->pembeli ?></td>
	           <td><?php echo $data->toko ?></td>
	           <td><?php echo $data->admin_toko ?></td>
						 <td><?php echo $data->mitra ?></td>
						 <td><?php echo"Rp " . number_format($a->nominal,2,',','.'); ?></td>
						 <td>&nbsp;</td>
	            <?php
	          $id_p = array();
	          if($data->dari_cart =="Ya"){
	            $id_p = explode(",",$data->produk_cart);
	            echo "<td class='cart_transaksi1'>";
	              for($b=0;$b<count($id_p);$b++) {
	                $this->db->from('tb_produk');
	                $this->db->where('id_produk',$id_p[$b]);
	                $hasil1 = $this->db->get();
	                foreach ($hasil1->result() as $hsl) {

	                  echo $hsl->nama.",";
	                }
	            }
	            echo "</td>";

	          }else{
	          ?>
	          <td><?php echo $data->produk ?></td>
	          <?php
	          }
	          ?>



	        </tr>
	                <?php } } ?>
	      </tbody>
	  </table>
              </div>
            </div>
            <div class="tab-pane" id="recent10">
              <div class="table-responsive">
              	<table  class="table table-bordered table-striped-col" id="mydata1">
              	 <thead>
	        <tr>
	          <th>Id Trx</th>
	          <th>Dropshiper</th>
	          <th>Toko</th>
	          <th>Adm Toko</th>
	          <th>Mitra</th>
	          <th>Barang</th>
	          <th>Nominal</th>


	        </tr>
	      </thead>
	      <tbody id="show_data2">
	        <?php

	        foreach ($ditolak as $a) {
	          $id_trx = $a->id_transaksi;
	         ?>
	        <tr>
	          <td class="id_transaksi" data_transaksi=<?php echo $a->id_transaksi ?>><?php echo $a->id_transaksi ?></td>
	          <?php
	            $query = $this->db->query("SELECT tb_pembayaran.id_transaksi,
	                                      tb_transaksi.id_transaksi,tb_transaksi.id_admin,tb_transaksi.id_supplier,tb_transaksi.id_brand,tb_transaksi.id_produk,tb_transaksi.id_pembeli,tb_transaksi.dari_cart,
	                                      tb_admin.id_admin,tb_admin.nama AS admin_toko,
	                                      tb_suplier.id_supplier,tb_suplier.nama AS mitra,
	                                      tb_brand.id_brand,tb_brand.nama AS toko,
	                                      tb_produk.id_produk,tb_produk.nama AS produk,
	                                      tb_pembeli.id_pembeli,tb_pembeli.username AS pembeli,
	                                      tb_transaksi.id_produk as produk_cart
	                                      FROM tb_pembayaran
	                                      JOIN tb_transaksi ON tb_pembayaran.id_transaksi=tb_transaksi.id_transaksi
	                                      JOIN tb_admin ON tb_transaksi.id_admin = tb_admin.id_admin
	                                      JOIN tb_suplier ON tb_transaksi.id_supplier = tb_suplier.id_supplier
	                                      JOIN tb_brand ON tb_transaksi.id_brand = tb_brand.id_brand
	                                      JOIN tb_produk ON tb_transaksi.id_produk= tb_produk.id_produk
	                                      JOIN tb_pembeli ON tb_transaksi.id_pembeli = tb_pembeli.id_pembeli
	                                      WHERE tb_pembayaran.id_transaksi ='$id_trx'");
	            $hasil= $query->result();
	            foreach ($hasil as $data) {
	              # code...

	           ?>
	           <td><?php echo $data->pembeli ?></td>
	           <td><?php echo $data->toko ?></td>
	           <td><?php echo $data->admin_toko ?></td>
	           <td><?php echo $data->mitra ?></td>
	           <?php
	          $id_p = array();
	          if($data->dari_cart =="Ya"){
	            $id_p = explode(",",$data->produk_cart);
	            echo "<td class='cart_transaksi2'>";
	              for($b=0;$b<count($id_p);$b++) {
	                $this->db->from('tb_produk');
	                $this->db->where('id_produk',$id_p[$b]);
	                $hasil1 = $this->db->get();
	                foreach ($hasil1->result() as $hsl) {

	                  echo $hsl->nama.",";
	                }
	            }
	            echo "</td>";

	          }else{
	          ?>
	          <td><?php echo $data->produk ?></td>
	          <?php
	          }
	          ?>
	          <td> <?php echo"Rp " . number_format($a->nominal,2,',','.'); ?></td>


	        </tr>
	                <?php } } ?>
	      </tbody>
	  </table>
              </div>
            </div>
            <div class="tab-pane" id="comments10">
            	<div class="table-responsive">
            	<table  class="table table-bordered table-striped-col" id="mydata2">
              
              	<thead>
	        <tr>
	          <th>Id Trx</th>
	          <th>Dropshiper</th>
	          <th>Toko</th>
	          <th>Adm Toko</th>
	          <th>Mitra</th>
	          <th>Barang</th>
	          <th>Nominal</th>


	        </tr>
	      </thead>
	      <tbody id="show_data3">
	        <?php

	        foreach ($disetujui as $a) {
	          $id_trx = $a->id_transaksi;
	         ?>
	        <tr>
	          <td class="id_transaksi" data_transaksi=<?php echo $a->id_transaksi ?>><?php echo $a->id_transaksi ?></td>
	          <?php
	            $query = $this->db->query("SELECT tb_pembayaran.id_transaksi,
	                                      tb_transaksi.id_transaksi,tb_transaksi.id_admin,tb_transaksi.id_supplier,tb_transaksi.id_brand,tb_transaksi.id_produk,tb_transaksi.id_pembeli,tb_transaksi.dari_cart,
	                                      tb_admin.id_admin,tb_admin.nama AS admin_toko,
	                                      tb_suplier.id_supplier,tb_suplier.nama AS mitra,
	                                      tb_brand.id_brand,tb_brand.nama AS toko,
	                                      tb_produk.id_produk,tb_produk.nama AS produk,
	                                      tb_pembeli.id_pembeli,tb_pembeli.username AS pembeli,
	                                      tb_transaksi.id_produk as produk_cart
	                                      FROM tb_pembayaran
	                                      JOIN tb_transaksi ON tb_pembayaran.id_transaksi=tb_transaksi.id_transaksi
	                                      JOIN tb_admin ON tb_transaksi.id_admin = tb_admin.id_admin
	                                      JOIN tb_suplier ON tb_transaksi.id_supplier = tb_suplier.id_supplier
	                                      JOIN tb_brand ON tb_transaksi.id_brand = tb_brand.id_brand
	                                      JOIN tb_produk ON tb_transaksi.id_produk= tb_produk.id_produk
	                                      JOIN tb_pembeli ON tb_transaksi.id_pembeli = tb_pembeli.id_pembeli
	                                      WHERE tb_pembayaran.id_transaksi ='$id_trx'");
	            $hasil= $query->result();
	            foreach ($hasil as $data) {
	              # code...

	           ?>
	           <td><?php echo $data->pembeli ?></td>
	           <td><?php echo $data->toko ?></td>
	           <td><?php echo $data->admin_toko ?></td>
	           <td><?php echo $data->mitra ?></td>
	 <?php
	          $id_p = array();
	          if($data->dari_cart =="Ya"){
	            $id_p = explode(",",$data->produk_cart);
	            echo "<td class='cart_transaksi3'>";
	              for($b=0;$b<count($id_p);$b++) {
	                $this->db->from('tb_produk');
	                $this->db->where('id_produk',$id_p[$b]);
	                $hasil1 = $this->db->get();
	                foreach ($hasil1->result() as $hsl) {

	                  echo $hsl->nama.",";
	                }
	            }
	            echo "</td>";

	          }else{
	          ?>
	          <td><?php echo $data->produk ?></td>
	          <?php
	          }
	          ?>
	          <td> <?php echo"Rp " . number_format($a->nominal,2,',','.'); ?></td>


	        </tr>
	                <?php } } ?>
	      </tbody>
	  </table>
              </div>
            </div>
          </div>
        </div><!-- col-md-6 -->
      </div>


      </div><!-- panel -->

    

    </div><!-- contentpanel -->
  </div>
  	<div class="modal bounceIn animated in" tabindex="-1" role="dialog" id="popup_" style="display: none;" aria-hidden="true" style="display: block; padding-right: 17px;">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content bg-light ">
					<div class="modal-header">
						<h5 class="modal-title text-center"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body" id="isi">

					</div>

				</div>
			</div>
		</div>
		<!-- Modal image -->
		<div class="modal bounceIn animated in" tabindex="-1" role="dialog" id="popup_image" style="display: none;" aria-hidden="true" style="display: block; padding-right: 17px;">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-light ">
			<div class="modal-header">
				<h3 class="text-center">Bukti Transfer</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body" >
				<div id="isi_image">
				</div>
			</div>

		</div>
	</div>
</div>

 <?php $this->load->view('keuangan/f'); ?>
  <script src="<?php echo base_url('assets/lib/datatables/jquery.dataTables.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js')?>"></script>
<script type="text/javascript">
   $(document).ready(function() {
		 function rupiah(angka){
			 var reverse = angka.toString().split('').reverse().join(''),
			ribuan = reverse.match(/\d{1,3}/g);
			ribuan = ribuan.join('.').split('').reverse().join('');
			return ribuan;
		 }
    $('#mydata').DataTable({ responsive: true});
    $('#mydata1').DataTable({ responsive: true});
    $('#mydata2').DataTable({ responsive: true});

		$('#show_data1').on('click','.id_transaksi',function(){
			var id_transaksi = $(this).attr('data_transaksi');
			var dr_cart = $('.cart_transaksi1').text();
			var barang;
			var resi;
			var kb;
				$('.modal-title').text("Detail Transfer");
				$('#isi').empty();
				$('#isi_image').empty();
			$.ajax({
					type : "GET",
					url  : "<?php echo base_url('keuangan_/ajax_detail_transfer')?>",
					dataType : "JSON",
					data : {id_transaksi:id_transaksi},
					success: function(data){
						$.each(data,function(id_pembayaran,bukti_transfer,id_transaksi,produk,nama_dropshiper,no_hp_dropshiper,nama_penerima, alamat_penerima,nama,no_tlp_penerima,jasa_kirim,service,ongkos_kirim,jumlah_beli,jumlah_biaya_produk,produk_dan_ongkir,jam_transaksi,resi,status,dari_cart){
							var id_pembayaran = data[0].id_pembayaran;
									if(data[0].dari_cart == "Ya"){
										barang = dr_cart;
										if(data[0].kode_booking=="" || data[0].kode_booking==null){
											kb="-";
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
										}else{
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
											kb =data[0].kode_booking;
										}

									}else{
										if(data[0].kode_booking=="" || data[0].kode_booking==null){
											kb="-";
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
										}else{
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
											kb =data[0].kode_booking;
										}

										barang = data[0].produk;
									}

									$('#isi').append("<table class='table table-no-border'>"+
									"<tr><td><b>Nama Dropshiper</b></td><td>"+data[0].nama_dropshiper+"</td><td><b>Telepon Dropshiper</b></td><td>"+data[0].no_hp_dropshiper+"</td></tr>"+
									"<tr><td><b>Nama Penerima</b></td><td>"+data[0].nama_penerima+"</td><td><b>Alamat Penerima</b></td><td>"+data[0].alamat_penerima+"</td></tr>"+
									"<tr><td><b>Telepon Penerima</b></td><td>"+data[0].no_tlp_penerima+"</td><td><b>Barang</b></td><td>"+barang+"</td></tr>"+
									"<tr><td><b>No Resi</b></td><td>"+resi+"</td><td><b>Kode Booking</b></td><td>"+kb+"</td></tr>"+
									"<tr><td><b>Harga</b></td><td>Rp "+rupiah(data[0].jumlah_biaya_produk)+"</td><td><b>Qty</b></td><td>"+data[0].jumlah_beli+"</td></tr>"+
									"<tr><td><b>Jasa Kirim</b></td><td>"+data[0].jasa_kirim+"</td><td><b>Layanan</b></td><td>"+data[0].service+"</td></tr>"+
									"<tr><td><b>Ongkir</b></td><td>Rp "+rupiah(data[0].ongkos_kirim)+"</td><td><b>Total</b></td><td>Rp "+rupiah(data[0].produk_dan_ongkir)+"</td></tr>"+
									"<tr><td><b>Waktu Transaksi</b></td><td>"+data[0].jam_transaksi+"</td><td><b>Status</b></td><td><span class='badge badge-inverse'>"+data[0].status+"</span></td></tr>"+
									"<tr><td><b>Nominal Transfer</b></td><td>Rp "+rupiah(data[0].nominal)+"</td><td class='lihat_struk'  colspan='2'><span class='badge badge-success'><b><i class='ace-icon fa fa-external-link'></i> Lihat Struk</b></span</td></tr>"+
									"</table>");
									if(data[0].status == "Menunggu Konfirmasi"){
										$('#isi').append("<table><tr><td>"+
										"<a href='<?php echo base_url() ?>keuangan_/tolak/"+id_pembayaran+"' class='btn btn-primary'><i class='fa fa-close'></i> Tolak</a>"+
					             "<a href='<?php echo base_url() ?>keuangan_/setujui/"+id_pembayaran+"' class='btn btn-danger'><span class='glyphicon glyphicon-ok-circle'></span> Setujui</a>"+
					          "</td></tr></table>");
									}else{

									}
									$('#isi_image').append("<img src='<?php echo base_url() ?>gambar/"+data[0].bukti_transfer+"' height='600' width='500'>");
									$('#popup_').modal('show');


					});
					}
			});
			return false;
		});
		$('#show_data2').on('click','.id_transaksi',function(){
			var id_transaksi = $(this).attr('data_transaksi');
			var dr_cart = $('.cart_transaksi2').text();
			var barang;
			var resi;
			var kb;
				$('.modal-title').text("Detail Transfer");
				$('#isi').empty();
				$('#isi_image').empty();
			$.ajax({
					type : "GET",
					url  : "<?php echo base_url('keuangan_/ajax_detail_transfer')?>",
					dataType : "JSON",
					data : {id_transaksi:id_transaksi},
					success: function(data){
						$.each(data,function(id_pembayaran,bukti_transfer,id_transaksi,produk,nama_dropshiper,no_hp_dropshiper,nama_penerima, alamat_penerima,nama,no_tlp_penerima,jasa_kirim,service,ongkos_kirim,jumlah_beli,jumlah_biaya_produk,produk_dan_ongkir,jam_transaksi,resi,status,dari_cart){
							var id_pembayaran = data[0].id_pembayaran;
									if(data[0].dari_cart == "Ya"){
										barang = dr_cart;
										if(data[0].kode_booking=="" || data[0].kode_booking==null){
											kb="-";
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
										}else{
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
											kb =data[0].kode_booking;
										}

									}else{
										if(data[0].kode_booking=="" || data[0].kode_booking==null){
											kb="-";
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
										}else{
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
											kb =data[0].kode_booking;
										}

										barang = data[0].produk;
									}

									$('#isi').append("<table class='table table-no-border'>"+
									"<tr><td><b>Nama Dropshiper</b></td><td>"+data[0].nama_dropshiper+"</td><td><b>Telepon Dropshiper</b></td><td>"+data[0].no_hp_dropshiper+"</td></tr>"+
									"<tr><td><b>Nama Penerima</b></td><td>"+data[0].nama_penerima+"</td><td><b>Alamat Penerima</b></td><td>"+data[0].alamat_penerima+"</td></tr>"+
									"<tr><td><b>Telepon Penerima</b></td><td>"+data[0].no_tlp_penerima+"</td><td><b>Barang</b></td><td>"+barang+"</td></tr>"+
									"<tr><td><b>No Resi</b></td><td>"+resi+"</td><td><b>Kode Booking</b></td><td>"+kb+"</td></tr>"+
									"<tr><td><b>Harga</b></td><td>Rp "+rupiah(data[0].jumlah_biaya_produk)+"</td><td><b>Qty</b></td><td>"+data[0].jumlah_beli+"</td></tr>"+
									"<tr><td><b>Jasa Kirim</b></td><td>"+data[0].jasa_kirim+"</td><td><b>Layanan</b></td><td>"+data[0].service+"</td></tr>"+
									"<tr><td><b>Ongkir</b></td><td>Rp "+rupiah(data[0].ongkos_kirim)+"</td><td><b>Total</b></td><td>Rp "+rupiah(data[0].produk_dan_ongkir)+"</td></tr>"+
									"<tr><td><b>Waktu Transaksi</b></td><td>"+data[0].jam_transaksi+"</td><td><b>Status</b></td><td><span class='badge badge-inverse'>"+data[0].status+"</span></td></tr>"+
									"<tr><td><b>Nominal Transfer</b></td><td>Rp "+rupiah(data[0].nominal)+"</td><td class='lihat_struk'  colspan='2'><span class='badge badge-success'><b><i class='ace-icon fa fa-external-link'></i> Lihat Struk</b></span</td></tr>"+
									"</table>");
									if(data[0].status == "Menunggu Konfirmasi"){
										$('#isi').append("<table><tr><td>"+
										"<a href='<?php echo base_url() ?>keuangan_/tolak/"+id_pembayaran+"' class='btn btn-sm rounded-pill btn-outline-danger'>Tolak</a>"+
					             "<a href='<?php echo base_url() ?>keuangan_/setujui/"+id_pembayaran+"' class='btn btn-sm rounded-pill btn-outline-success'>Setujui</a>"+
					          "</td></tr></table>");
									}else{

									}
									$('#isi_image').append("<img src='<?php echo base_url() ?>gambar/"+data[0].bukti_transfer+"' height='600' width='500'>");
									$('#popup_').modal('show');


					});
					}
			});
			return false;
		});
		$('#show_data3').on('click','.id_transaksi',function(){
			var id_transaksi = $(this).attr('data_transaksi');
			var dr_cart = $('.cart_transaksi3').text();
			var barang;
			var resi;
			var kb;
				$('.modal-title').text("Detail Transfer");
				$('#isi').empty();
				$('#isi_image').empty();
			$.ajax({
					type : "GET",
					url  : "<?php echo base_url('keuangan_/ajax_detail_transfer')?>",
					dataType : "JSON",
					data : {id_transaksi:id_transaksi},
					success: function(data){
						$.each(data,function(id_pembayaran,bukti_transfer,id_transaksi,produk,nama_dropshiper,no_hp_dropshiper,nama_penerima, alamat_penerima,nama,no_tlp_penerima,jasa_kirim,service,ongkos_kirim,jumlah_beli,jumlah_biaya_produk,produk_dan_ongkir,jam_transaksi,resi,status,dari_cart){
							var id_pembayaran = data[0].id_pembayaran;
									if(data[0].dari_cart == "Ya"){
										barang = dr_cart;
										if(data[0].kode_booking=="" || data[0].kode_booking==null){
											kb="-";
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
										}else{
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
											kb =data[0].kode_booking;
										}

									}else{
										if(data[0].kode_booking=="" || data[0].kode_booking==null){
											kb="-";
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
										}else{
											if(data[0].resi==null){
												resi="-";
											}else{
												resi=data[0].resi;
											}
											kb =data[0].kode_booking;
										}

										barang = data[0].produk;
									}

									$('#isi').append("<table class='table table-no-border'>"+
									"<tr><td><b>Nama Dropshiper</b></td><td>"+data[0].nama_dropshiper+"</td><td><b>Telepon Dropshiper</b></td><td>"+data[0].no_hp_dropshiper+"</td></tr>"+
									"<tr><td><b>Nama Penerima</b></td><td>"+data[0].nama_penerima+"</td><td><b>Alamat Penerima</b></td><td>"+data[0].alamat_penerima+"</td></tr>"+
									"<tr><td><b>Telepon Penerima</b></td><td>"+data[0].no_tlp_penerima+"</td><td><b>Barang</b></td><td>"+barang+"</td></tr>"+
									"<tr><td><b>No Resi</b></td><td>"+resi+"</td><td><b>Kode Booking</b></td><td>"+kb+"</td></tr>"+
									"<tr><td><b>Harga</b></td><td>Rp "+rupiah(data[0].jumlah_biaya_produk)+"</td><td><b>Qty</b></td><td>"+data[0].jumlah_beli+"</td></tr>"+
									"<tr><td><b>Jasa Kirim</b></td><td>"+data[0].jasa_kirim+"</td><td><b>Layanan</b></td><td>"+data[0].service+"</td></tr>"+
									"<tr><td><b>Ongkir</b></td><td>Rp "+rupiah(data[0].ongkos_kirim)+"</td><td><b>Total</b></td><td>Rp "+rupiah(data[0].produk_dan_ongkir)+"</td></tr>"+
									"<tr><td><b>Waktu Transaksi</b></td><td>"+data[0].jam_transaksi+"</td><td><b>Status</b></td><td><span class='badge badge-inverse'>"+data[0].status+"</span></td></tr>"+
									"<tr><td><b>Nominal Transfer</b></td><td>Rp "+rupiah(data[0].nominal)+"</td><td class='lihat_struk'  colspan='2'><span class='badge badge-success'><b><i class='ace-icon fa fa-external-link'></i> Lihat Struk</b></span</td></tr>"+
									"</table>");
									if(data[0].status == "Menunggu Konfirmasi"){
										$('#isi').append("<table><tr><td>"+
										"<a href='<?php echo base_url() ?>keuangan_/tolak/"+id_pembayaran+"' class='btn btn-sm rounded-pill btn-outline-danger'>Tolak</a>"+
					             "<a href='<?php echo base_url() ?>keuangan_/setujui/"+id_pembayaran+"' class='btn btn-sm rounded-pill btn-outline-success'>Setujui</a>"+
					          "</td></tr></table>");
									}else{

									}
									$('#isi_image').append("<img src='<?php echo base_url() ?>gambar/"+data[0].bukti_transfer+"' height='600' width='500'>");
									$('#popup_').modal('show');


					});
					}
			});
			return false;
		});
		$('#popup_').on('click','.lihat_struk',function(){
			$('#popup_image').modal('show');
		});


} );
</script>
        </body>
</html>

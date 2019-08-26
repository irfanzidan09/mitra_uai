<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("admin/_partial/head.php") ?>
</head>
<body>

<?php $this->load->view("keuangan/header.php") ?>
<div class="container my-3">
	<div class="row">

		<div class="col mt-3 mt-md-0">
          <div class="card">
						<div class="card-header bg-white border-bottom flex-center p-0 mt-3">
							<ul class="nav nav-pills card-header-pills main-nav-pills" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="data-pesanan-anda" data-toggle="tab" href="#pesanan_anda" role="tab" aria-controls="pesanan_anda" aria-selected="true">Permintaan Refound</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="data-pesanan-batal" data-toggle="tab" href="#pesanan_batal" role="tab" aria-controls="pesanan_batal" aria-selected="false">Data Refound Selesai</a>
								</li>

							</ul>
						</div>
						<div class="tab-content">
							<div class="card-body tab-pane fade show active" id="pesanan_anda" role="tabpanel" aria-labelledby="data-pesanan-anda">
								<table class="table table-striped table-hover " id="mydata">
	      <thead>
	        <tr>
	          <th>Id Trx</th>
	          <th>Dropshiper</th>
	          <th>Toko</th>
	          <th>Adm Toko</th>
	          <th>Mitra</th>
	          <th>Barang</th>
	          <th>Nominal</th>
	          <th>Struk</th>
	          <th>Status</th>
	          <th>Pilihan</th>
	        </tr>
	      </thead>
	      <tbody id="show_data">
	        <?php

	        foreach ($request_refound as $a) {
	          $id_trx = $a->id_transaksi;
	         ?>
	        <tr>
	          <td><?php echo $a->id_transaksi ?></td>
	          <?php
	            $query = $this->db->query("SELECT tb_pembayaran.id_transaksi,
	                                      tb_transaksi.id_transaksi,tb_transaksi.id_admin,tb_transaksi.id_supplier,tb_transaksi.id_brand,tb_transaksi.id_produk,tb_transaksi.id_pembeli,
	                                      tb_admin.id_admin,tb_admin.nama AS admin_toko,
	                                      tb_suplier.id_supplier,tb_suplier.nama AS mitra,
	                                      tb_brand.id_brand,tb_brand.nama AS toko,
	                                      tb_produk.id_produk,tb_produk.nama AS produk,
	                                      tb_pembeli.id_pembeli,tb_pembeli.username AS pembeli
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
	           <td><?php echo $data->produk ?></td>
	          <td> <?php echo"Rp " . number_format($a->nominal,2,',','.'); ?></td>
	          <td><img alt="Snow" style="width:100%;max-width:200px;height:100px" id="zoom1" src="<?php echo base_url().'gambar/'.$a->bukti_transfer ?>"></td>
	          <td><?php echo $a->st ?></td>
	          <td><a href="<?php echo base_url().'keuangan_/accept_refound/'.$a->id_transaksi ?>"><span class="badge badge-success">Refound</span></a></td>
	        </tr>
	                <?php } } ?>
	      </tbody>
	    </table>
							</div>
							<div class="card-body tab-pane fade show " id="pesanan_batal" role="tabpanel" aria-labelledby="data-pesanan-batal">
								<table class="table table-striped table-hover " id="mydata1">
	      <thead>
	        <tr>
	          <th>Id Trx</th>
	          <th>Dropshiper</th>
	          <th>Toko</th>
	          <th>Adm Toko</th>
	          <th>Mitra</th>
	          <th>Barang</th>
	          <th>Nominal</th>

	          <th>Status</th>

	        </tr>
	      </thead>
	      <tbody id="show_data">
	        <?php

	        foreach ($proses_refound as $a) {
	          $id_trx = $a->id_transaksi;
	         ?>
	        <tr>
	          <td><?php echo $a->id_transaksi ?></td>
	          <?php
	            $query = $this->db->query("SELECT tb_pembayaran.id_transaksi,
	                                      tb_transaksi.id_transaksi,tb_transaksi.id_admin,tb_transaksi.id_supplier,tb_transaksi.id_brand,tb_transaksi.id_produk,tb_transaksi.id_pembeli,
	                                      tb_admin.id_admin,tb_admin.nama AS admin_toko,
	                                      tb_suplier.id_supplier,tb_suplier.nama AS mitra,
	                                      tb_brand.id_brand,tb_brand.nama AS toko,
	                                      tb_produk.id_produk,tb_produk.nama AS produk,
	                                      tb_pembeli.id_pembeli,tb_pembeli.username AS pembeli
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
	           <td><?php echo $data->produk ?></td>
	          <td> <?php echo"Rp " . number_format($a->nominal,2,',','.'); ?></td>

	          <td><span class="badge badge-success"><?php echo $a->status ?></span></td>

	        </tr>
	                <?php } } ?>
	      </tbody>
	    </table>
							</div>

</div>


          </div>
        </div>
	</div>
	</div>
        <?php $this->load->view("admin/_partial/footer.php") ?>

        <?php $this->load->view("admin/_partial/modal.php") ?>
        <?php $this->load->view("admin/_partial/js.php") ?>
<script type="text/javascript">
   $(document).ready( function () {
    $('#mydata').DataTable();
    $('#mydata1').DataTable();
    $('#mydata2').DataTable();
    $('#mydata3').DataTable();
    $('#mydata4').DataTable();
    $('#mydata5').DataTable();
} );
</script>
        </body>
</html>

<link rel="stylesheet" href="<?php echo base_url() ?>assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">
<div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Admin</a></li>
        <li><a href="#">Data Penjualan</a></li>
        
      </ol>

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">Data Penjualan</h4>
           
        </div>
        
        <div class="panel-body">
          <div class="table-responsive">
            <table  class="table table-bordered table-striped-col" id="mydata">
        <thead>
        <tr>
					<th>No</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Kategori</th>
					<th>Stok</th>
          <th>Terjual</th>
					<th>Sisa</th>
        </tr>
      </thead>
      <tbody id="show_data">
        <?php
				$i=0;
        foreach ($jumlah_terjual as $a) {
					$id_produk = $a->id_produk;
					$stok = $a->stok; ?>
        <tr>
					<td><?php echo ($i +=1); ?></td>
          <td><?php 	$jumlah_string = strlen($a->nama);
						if($jumlah_string > 50){
						echo substr($a->nama,0,20)."<a href='".base_url()."produk/view/".$a->id_produk."'>......</a>";
						}else{
						echo $a->nama	;
					} ?></td>
          <td><?php echo "Rp " . number_format($a->harga,2,',','.'); ?></td>
          <td><?php echo $a->kategori ?></td>
					<td><?php echo $a->stok ?></td>
          <td>
						<?php
						$id_p = array();
						$jb = array();
						$this->db->select("SUM(jumlah_beli) as terjual");
						$this->db->from('tb_transaksi');
						$this->db->where('id_produk',$a->id_produk);
						$this->db->where('dari_cart','Tidak');
						$hasil = $this->db->get();
						$z=0;
						foreach ($hasil->result() as $x) {
							$a = $x->terjual;
						}
						$this->db->from('tb_transaksi');
						$this->db->where('dari_cart','Ya');
						$this->db->where('status','Delivered');
						$hasil1 = $this->db->get();

						foreach ($hasil1->result() as $k) {
							$id_p = explode(",",$k->id_produk);
							$jb = explode(",",$k->jumlah_beli);
							for($b=0;$b<count($id_p);$b++){
								if($id_produk == $id_p[$b]){
									$z = $jb[$b];
								}else{

								}
							}
						}
						echo $a+$z;
						?>
					</td>
					<td><?php echo $stok  - ($a+$z); ?></td>
        </tr>
                <?php } ?>
      </tbody>
    </table>
          </div>
        </div>
      </div><!-- panel -->

    

    </div><!-- contentpanel -->
  </div>


  <?php $this->load->view('super_admin/super/f'); ?>
  <script src="<?php echo base_url('assets/lib/datatables/jquery.dataTables.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js')?>"></script>
  <script type="text/javascript">
   $(document).ready( function () {
    'use strict';
    $('#mydata').DataTable();
} );
</script>
</body> 
</html>
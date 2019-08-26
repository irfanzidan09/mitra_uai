<link rel="stylesheet" href="<?php echo base_url() ?>assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">
<div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Admin</a></li>
        <li><a href="#">Admin Toko</a></li>
        
      </ol>

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">Admin Toko</h4>
          
        </div>
        <div class="panel-body">
        	<div class="row">
        <!-- col-md-6 -->
        <div class="col-md-12">

         

          <!-- Nav tabs -->
          <ul class="nav nav-tabs nav-inverse nav-justified">
            <li class="active"><a href="#popular10" data-toggle="tab" aria-expanded="true"><strong>Brand Baru</strong></a></li>
            <li class=""><a href="#recent10" data-toggle="tab" aria-expanded="false"><strong>Brand Bermitra</strong></a></li>
            
          </ul>

          <!-- Tab panes -->
          <div class="tab-content mb20">
            <div class="tab-pane active" id="popular10">
             <div class="table-responsive">
             		<table class="table table-striped table-hover " id="mydata">
		      <thead>
		        <tr>
		          <th>Nama Toko</th>
		          <th>Admin Toko</th>
		          <th>Kategori</th>
		          <th style="text-align: right;">Aksi</th>
		        </tr>
		      </thead>
		      <tbody id="show_data">
		        <?php

		        foreach ($toko_admin as $a) { ?>
		        <tr>
		          <td><?php echo $a->brand ?></td>
		          <td><?php echo $a->admin_toko ?></td>
		          <td><?php echo $a->kategori ?></td>
		          <td>
		            <a href="javascript:;" class="btn btn-sm add_mitra" data=<?php echo $a->id_brand ?>><i class="ace-icon fa fa-user	"></i>&nbsp;Input Mitra</a>


							</td>
		        </tr>
		                <?php } ?>
		      </tbody>
		    </table>
             </div>
            </div>
            <div class="tab-pane" id="recent10">
           		<table class="table table-striped table-hover " id="mydata2">
		      <thead>
		        <tr>
		          <th>Nama Toko</th>
		          <th>Admin Toko</th>
		          <th>Kategori</th>
		          <th style="text-align: right;">Aksi</th>
		        </tr>
		      </thead>
		      <tbody id="show_data">
		        <?php

		        foreach ($brand_bermitra as $a) { ?>
		        <tr>
		          <td><?php echo $a->brand ?></td>
		          <td><?php echo $a->admin_toko ?></td>
		          <td><?php echo $a->kategori ?></td>
		          <td>
		            <a href="javascript:;" class="btn btn-sm add_mitra" data=<?php echo $a->id_brand ?>><i class="ace-icon fa fa-user	"></i>&nbsp;Input Mitra</a>


							</td>
		        </tr>
		                <?php } ?>
		      </tbody>
		    </table>
            </div>
           
          </div>
        </div><!-- col-md-6 -->
      </div>
         
        </div>
      </div><!-- panel -->

    

    </div><!-- contentpanel -->
  </div>


  
								

		<div class="modal bounceIn animated in" tabindex="-1" role="dialog" id="admin_toko" style="display: none;" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-light ">
          <div class="modal-header">
            <h5 class="modal-title">Daftar Mitra</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
						<input type="hidden" name="id_brand" id="brand">
						<div class="table-responsive">
						<table class="table table-bordered table-striped-col" id="mydata1">
		<thead>
			<tr>
				<th>Nama</th>
				<th>Wilayah</th>
				<th>Kategori Produk</th>

				<th style="text-align: right;">Aksi</th>
			</tr>
		</thead>
		<tbody id="show_data">
			<?php
			foreach ($daftar_mitra as $a) { ?>
			<tr>
				<td><?php echo $a->nama ?></td>
				<td><?php echo $a->wilayah ?></td>
				<td><?php echo $a->kategori_produk ?></td>
				<td>
					<a href="javascript:;" class="btn btn-sm tambah"  data-sup=<?php echo $a->id_supplier ?>><i class="ace-icon fa fa-pencil-square-o	"></i>&nbsp;Tambah</a>
				</td>
			</tr>
							<?php } ?>
		</tbody>
	</table>
</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn rounded-pill btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn rounded-pill btn-primary">Submit review</button>
          </div>
        </div>
      </div>
    </div>

       <?php $this->load->view('super_admin/super/f'); ?>
  <script src="<?php echo base_url('assets/lib/datatables/jquery.dataTables.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js')?>"></script>
<script type="text/javascript">
   $(document).ready( function () {
    $('#mydata').DataTable();
	$('#mydata1').DataTable();
	$('#mydata2').DataTable();
		$('.tambah').on('click',function(){
						var id_brand=$('#brand').val();
						var id_supplier=$(this).attr('data-sup');
						$.ajax({
								type : "POST",
								url  : "<?php echo base_url('admin/add_mitra')?>",
								dataType : "JSON",
								data : {id_brand:id_brand, id_supplier:id_supplier},
								success:function(data){
								$('#admin_toko').modal('hide');
								location.reload();
								}
						});
						return false;
		});

	});
	$('#show_data').on('click','.add_mitra',function(){
					var id_brand=$(this).attr('data');
					$('#admin_toko').modal('show');
					$('[name="id_brand"]').val(id_brand);
	});




</script>
        </body>
</html>

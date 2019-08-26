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
          <div class="table-responsive">
            <table  class="table table-bordered table-striped-col" id="mydata">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>No HP</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>No HP</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </tfoot>
      <tbody id="show_data">
        <?php

        foreach ($admins->result() as $a) { ?>
        <tr>
          <td><?php echo $a->nama ?></td>
          <td><?php echo $a->jenis_kelamin ?></td>

          <td><?php echo $a->no_hp ?></td>
          <td><?php echo $a->alamat ?></td>
          <td>
            <a href="javascript:;" class="btn btn-sm rounded-pill btn-outline-inverse" data=<?php echo $a->id_admin ?>><i class="ace-icon fa fa-pencil-square-o bigger-120 black"></i>&nbsp;Edit</a>

            <a href="javascript:;" class="btn btn-sm rounded-pill btn-outline-inverse" data=<?php echo $a->id_admin ?>><i class="ace-icon fa fa-ban bigger-120 black"></i>&nbsp;Hapus</a>
            <a href="<?php echo base_url().'admin/view_admin_toko/'.$a->id_admin ?>" class="btn btn-sm rounded-pill btn-outline-inverse" data=<?php echo $a->id_admin ?>><i class="ace-icon fa fa-external-link bigger-120 black "></i>&nbsp;Lihat Toko</a>
            
          </td>
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
$('#show_data').on('click','.view',function(){
        var id_admin=$(this).attr('data');
        $.ajax({
            type : "GET",
            url  : "<?php echo base_url('admin/toko_admin')?>",
            dataType : "JSON",
            data : {id_admin:id_admin},
            success: function(data){
              $.each(data,function(id_admin,admin_toko){
                    $('#admin_toko').modal('show');
                    $('[name="id_admin"]').val(data.admin_toko);

            });
            }
        });
        return false;

  });
</script>
</body> 
</html>
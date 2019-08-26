<link rel="stylesheet" href="<?php echo base_url() ?>assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">
<div class="mainpanel">

    <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="#"><i class="fa fa-home mr5"></i> Admin</a></li>
        <li><a href="#">Pj Keuangan</a></li>
        
      </ol>

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">Pj Keuangan</h4>
           
        </div>
        
        <div class="panel-body">
          <div class="table-responsive">
            <table  class="table table-bordered table-striped-col" id="mydata">
       <thead>
        <tr>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Username</th>
          <th>No HP</th>
          <th>Alamat</th>
          
          <th style="text-align: right;">Aksi</th>
        </tr>
      </thead>
      <tbody id="show_data">
        <?php 

        foreach ($keuangan->result() as $a) { ?>
        <tr>
          <td><?php echo $a->nama ?></td>
          <td><?php echo $a->jenis_kelamin ?></td>
          <td><?php echo $a->username ?></td>
          <td><?php echo $a->no_hp ?></td>
          <td><?php echo $a->alamat ?></td>
          <td>
            <a href="javascript:;" class="btn btn-sm rounded-pill btn-outline-success" data=<?php echo $a->id_pj_keuangan ?>><i class="ace-icon fa fa-pencil-square-o bigger-120 black"></i>&nbsp;Edit</a>
            
            <a href="javascript:;" class="btn btn-sm rounded-pill btn-outline-warning" data=<?php echo $a->id_pj_keuangan ?>><i class="ace-icon glyphicon glyphicon-off"></i>&nbsp;Hapus</a>
                        
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

</script>
</body> 
</html>
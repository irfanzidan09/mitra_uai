<link rel="stylesheet" href="<?php echo base_url() ?>assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css">
<div class="mainpanel">

   <div class="contentpanel">

      <ol class="breadcrumb breadcrumb-quirk">
        <li><a href="index.html"><i class="fa fa-home mr5"></i> Admin</a></li>
        <li><a href="general-forms.html">Admin Toko</a></li>
        <li class="active">Tambah Data</li>
      </ol>

      <div class="row">
        <div class="col-sm-12">
          <div class="panel">
            <div class="panel-heading">
             
            </div>
            <div class="panel-body">
                <form class="form-style-1" method="post" action="<?php echo base_url() ?>keuangan/input">
                
                  <div class="form-group col-sm-6">
                    <label for="billingAddress">Nama</label>
                    <input type="text" required="true" class="form-control" name="nama" placeholder="Nama">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="billingAddress">Username</label>
                    <input type="text" required="true" class="form-control" name="username" placeholder="Username">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="billingAddress">Password</label>
                    <input type="password" required="true" class="form-control" name="password" placeholder="Password">
                  </div>
          <div class="form-group col-sm-6">
                    <label for="billingAddress">Foto</label>
                    <input type="file" class="form-control" name="foto">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="billingAddress">Tempat Tanggal Lahir</label>
                    <input type="text" required="true" class="form-control" name="ttl" placeholder="Tempat Tanggal Lahir">
                  </div>         
                  <div class="form-group col-sm-6 ">
                    <label for="billingCountry">Jenis Kelamin</label>
                    <select required="true" class="form-control custom-select" name="jenis_kelamin">
                      <option></option>
                      
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan" >Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="billingAddress">No HP</label>
                    <input type="text" class="form-control" name="no_hp" placeholder="No HP">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="billingAddress">Nama Ayah</label>
                    <input required="true" type="text" class="form-control" name="nama_ayah" placeholder="Nama Ayah">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="billingAddress">Nama Ibu</label>
                    <input required="true" type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu">
                  </div>
                  <div class="form-group col-sm-6 ">
                    <label for="billingCountry">Pendidikan Terakhir</label>
                    <select required="true" class="form-control custom-select" name="pendidikan">
                      <option></option>
                      <option value="SD">SD</option>
                      <option value="SMP">SMP</option>
                      <option value="SMA" >SMA</option>
                      <option value="S1" >S1</option>
                      <option value="S2" >S2</option>
                    </select>
                  </div>
                   <div class="form-group col-sm-6">
                    <label for="billingAddress">Hasil Stifin</label>
                    <input required="true" type="text" class="form-control" name="stifin" placeholder="Hasil Stifin">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="billingAddress">Alamat</label>
                    <textarea required="true" class="form-control" name="alamat" placeholder="Alamat"></textarea>
                  </div>
                 
               <div class="form-group col-sm-2">
                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save"></span> Simpan</button>
                </div>
              </form>
            </div>
          </div>

        </div><!-- col-sm-6 -->
      </div><!-- row -->

    </div>
  </div>


  <?php $this->load->view('super_admin/super/f'); ?>
  <script src="<?php echo base_url('assets/lib/datatables/jquery.dataTables.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js')?>"></script>
  
</body> 
</html>
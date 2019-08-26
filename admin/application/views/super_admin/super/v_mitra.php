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
                <form class="form-style-1" method="post" action="<?php echo base_url() ?>mitra/input">
                
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
                    <label for="billingAddress">Alamat</label>
                    <textarea required="true" class="form-control" name="alamat" placeholder="Alamat"></textarea>
                  </div>
                   <div class="form-group col-sm-4">
                    <label for="billingAddress">Provinsi</label>
                      <select required="true" class="form-control" id="list_provinsi">
                        <option value=""> Pilih Provinsi</option>
                      </select>
                    </div>

                    <div class="form-group col-sm-4" id="div_kota">
                      <label for="billingAddress">Kabupaten / Kota</label>

                      <select required="true" class="form-control kota" id="list_kotakab" name="id_wilayah" >
                        <option value=""> Pilih Kota</option>
                      </select>

                  </div>
                  <div class="form-group col-sm-4" id="div_kecamatan">
                    <label for="billingAddress">Kecamatan</label>
                    <input type="hidden" name="nama_wilayah" id="nama_wilayah">

                    <select required="true" class="form-control kota" id="list_kecamatan"  >
                      <option value=""> Pilih Kota</option>
                    </select>

                </div>
                   <div class="form-group col-sm-6">
                    <label for="billingAddress">No HP</label>
                    <input required="true" type="text" class="form-control" name="no_hp" placeholder="No HP">
                  </div>
                   <div class="form-group col-sm-6">
                    <label for="billingAddress">Email</label>
                    <input required="true" type="text" class="form-control" name="email" placeholder="Email">
                  </div>
                   <div class="form-group col-sm-6 ">
                    <label for="billingCountry">Kategori Produk</label>
                    <select required="true" class="form-control custom-select" name="kategori">
                      <option></option>
                        <option value="Fashion Wanita">Fashion Wanita</option>
                        <option value="Fashion Pria">Fashion Pria</option>
                        <option value="Fashion Anak">Fashion Anak</option>
                        <option value="Rumah Tangga">Rumah Tangga</option>
                        <option value="Hobi & Koleksi">Hobi & Koleksi</option>
                        <option value="Fashion Muslim">Fashion Muslim</option>
                        <option value="Makanan Minuman">Makanan Minuman</option>
                        <option value="Handphone & Aksesoris">Handphone & Aksesoris</option>
                        <option value="Industrialis">Industrialis</option>
                        <option value="Kompurt & Aksesoris">Komputer & Aksesoris</option>

                    </select>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="billingAddress">No Rekening</label>
                    <input required="true" type="text" class="form-control" name="rekening" placeholder="Nomor Rekening">
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="billingCountry">Bank</label>
                    <select required="true" class="form-control custom-select" name="bank">
                      <option></option>
                      <option value="BRI">BRI</option>
                      <option value="BNI">BNI</option>
                      <option value="BCA" >BCA</option>
                      <option value="Bank Jatim" >Bank Jatim</option>
                      <option value="Mandiri" >Mandiri</option>
                    </select>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="billingAddress">Atas Nama</label>
                    <input required="true" type="text" class="form-control" name="atas_nama" placeholder="Atas Nama">
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
   <script type="text/javascript">
      //* select Provinsi */
var base_url    = "<?php echo base_url();?>";
$.ajax({
    type: 'post',
    url: base_url + 'mitra/rajaongkir_get_provinsi',
    data: {},
    dataType  : 'html',
    success: function (data) {
        $("#list_provinsi").html(data);
    }
});
/* select Provinsi */
$("#list_provinsi").change(function(){
    var id_province = this.value;
    kota(id_province);
    $("#div_kota").show();
});
$('#list_kecamatan').change(function(){
  var nama = $('#list_kecamatan').find(':selected').attr('wil');
  $('#nama_wilayah').val("Kec. "+nama);
});
/* select Kota */
kota = function(id_province){
    $.ajax({
    type: 'post',
    url: base_url + 'mitra/rajaongkir_get_kota',
    data: {id_province:id_province},
    dataType  : 'html',
    success: function (data) {
        $("#list_kotakab").html(data);
    },
    beforeSend: function () {

    },
    complete: function () {

    }
});

}
$("#list_kotakab").change(function(){
    var id_kota = this.value;
    kecamatan(id_kota);
    $("#div_kecamatan").show();
});
kecamatan = function(id_kota){
    $.ajax({
    type: 'post',
    url: base_url + 'mitra/rajaongkir_get_kecamatan',
    data: {id_kota:id_kota},
    dataType  : 'html',
    success: function (data) {
        $("#list_kecamatan").html(data);
    }
});

}
      </script>
</body> 
</html>
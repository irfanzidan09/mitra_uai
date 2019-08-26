$('#something').click(function() {
    location.reload();
});

//------------------------------------------------------------
function sembunyi(){
	document.getElementById("alert").classList.add('hidden');
}
//----------------------------------------------------------------
autosize($('#autosize'));
//------------------------------------------------------------------
function confirmDialog() {
 return confirm('Apakah anda yakin akan menghapus data barang ini?');
}
//---------------------------------------------------------------------
            function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;
            return true;
            }
            //----------------------------
            function formatangka(objek) {
             a = $('#harga').val();
             b = a.replace(/[^\d]/g,"");
             c = "";
             panjang = b.length;
             j = 0;
             for (i = panjang; i > 0; i--) {
               j = j + 1;
               if (((j % 3) == 1) && (j != 1)) {
                 c = b.substr(i-1,1) + "." + c;
               } else {
                 c = b.substr(i-1,1) + c;
               }
             }
             objek.value = c;
          }
           //-------------------------------------
          function formatangka2(objek) {
             a = $('#harga2').val();
             b = a.replace(/[^\d]/g,"");
             c = "";
             panjang = b.length;
             j = 0;
             for (i = panjang; i > 0; i--) {
               j = j + 1;
               if (((j % 3) == 1) && (j != 1)) {
                 c = b.substr(i-1,1) + "." + c;
               } else {
                 c = b.substr(i-1,1) + c;
               }
             }
             objek.value = c;
          }
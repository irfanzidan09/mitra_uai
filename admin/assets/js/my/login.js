function setFocus() {
    document.getElementById("kode").focus();
    }
function falidasi(){
    var kode = document.getElementById("kode").value;
    var kode2 = document.getElementById("kode2").value;

    if (kode != kode2) {
          document.getElementById('kode').value = "";
          setFocus();
          document.getElementById("alert").classList.remove('hidden');
          return false; 
    }else{
          return true; 
    }

    ;}

 function sembunyi(){
 	document.getElementById("alert").classList.add('hidden');
 }
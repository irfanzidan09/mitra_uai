function mouseoverPass2(obj){
  var obj = document.getElementById('pass2');
  obj.type = "text"; }
//========================================
  function mouseoutPass2(obj){
    var obj = document.getElementById('pass2');
    obj.type = "password";}
//========================================
    function mouseoverPass(obj){
    var obj = document.getElementById('pass');
    obj.type = "text";}
//========================================
  function mouseoutPass(obj){
    var obj = document.getElementById('pass');
    obj.type = "password";}
//========================================

    function falidasi(){
    var userPass = document.getElementById("pass").value;
    var userPass2 = document.getElementById("pass2").value;
var size=3028;
var file_size=document.getElementById('file_upload').files[0].size;

    if (userPass != userPass2) {
          document.getElementById('pass2').value = "";
          setFocus();
          document.getElementById("alert").classList.remove('hidden');
          return false; 

}else if(file_size>=size){
document.getElementById("gambar").classList.remove('hidden');
return false;
  }}
  

//=========================================
    function setFocus() {
    document.getElementById("pass2").focus();
    }
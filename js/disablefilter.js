function disableFilter(){
  var disable1 = document.getElementById('disabledjs1');
  var disable2 = document.getElementById('disabledjs2');
  if(disable1.disabled == false){
    disable1.value = "";
    disable1.disabled = true;
  }else{
    disable1.disabled = false;
  }
  if(disable2.disabled == false){
    disable2.value = "";
    disable2.disabled = true;
  }else{
    disable2.disabled = false;
  }
}

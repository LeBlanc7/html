function validcheck(){
  
  form = document.insertform;
  
  if(form.loc.value==""){
    alert("지점명을 입력한 후 제출해주세요");
    return false;
  }
  else{
    return true;
  }
}

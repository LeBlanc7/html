function validcheck(){
  
  form = document.insertform;
  
  if(form.rate.value==""){
    alert("등급을 입력한 후 제출해주세요");
    return false;
  }
  else{
    return true;
  }
}

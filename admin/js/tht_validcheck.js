function validcheck(){
  
  form = document.insertform;
  
  if(form.tht.value==""){
    alert("상영관 이름을 입력한 후 제출해주세요");
    return false;
  }
  else{
    return true;
  }
}

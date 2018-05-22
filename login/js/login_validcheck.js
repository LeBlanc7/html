function validcheck(){
  
  form = document.insertform;
  
  if(form.id.value==""){
    alert("ID를 입력해주세요");
    return false;
  }
  else if(form.pw.value==""){
    alert("비밀번호를 입력해주세요");
    return false;
  }
  else{
    return true;
  }
}

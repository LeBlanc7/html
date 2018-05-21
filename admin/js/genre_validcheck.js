function validcheck(){
  
  form = document.insertform;
  
  if(form.genre.value==""){
    alert("장르를 입력한 후 제출해주세요");
    return false;
  }
  else{
    return true;
  }
}

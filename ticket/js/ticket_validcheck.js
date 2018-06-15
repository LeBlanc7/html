function validcheck(){
  
  form = document.insertform;
  
  if(form.py_mtd_nm.value==""){
    alert("결제방법을 선택해주세요");
    return false;
  }
  else{
    return true;
  }
}

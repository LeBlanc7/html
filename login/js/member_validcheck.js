function validcheck(){

  form = document.insertform;

  if(form.id.value==""){
    alert("I D 를 입력해주세요");
    return false;
  }
  else if(form.pw.value==""){
    alert("비밀번호를 입력해주세요");
    return false;
  }
  else if(form.mem_nm.value==""){
    alert("이름을 입력해주세요");
    return false;
  }
  else if(form.ph_num.value==""){
    alert("연락처를 입력해주세요");
    return false;
  }
  else if(form.rrnum1.value==""||form.rrnum2.value==""){
    alert("주민등록번호를 입력해주세요");
    return false;
  }
  else{
    return true;
  }
}

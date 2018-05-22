function validcheck(){
  
  form = document.insertform;
  
  if(form.mv_nm.value==""){
    alert("영화 제목을 입력해주세요");
    return false;
  }
  else if(form.dir_nm.value==""){
    alert("감독을 입력해주세요");
    return false;
  }
  else if(form.mv_int.value==""){
    alert("영화 소개를 입력해주세요");
    return false;
  }
  else if(form.atr_nm1.value==""){
    alert("배우를 1명 이상 입력해주세요");
    return false;
  }
  else if(form.scr_time.value==""){
    alert("상영 시간을 입력해주세요");
    return false;
  }
  else if(form.genre.value==""){
    alert("영화 장르를 입력해주세요");
    return false;
  }
  else if(form.rate.value==""){
    alert("관람 등급을 입력해주세요");
    return false;
  }
  else{
    return true;
  }
}

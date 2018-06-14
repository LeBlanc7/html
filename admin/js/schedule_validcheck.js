function validcheck(){

  form = document.insertform;

  if(form.loc.value==""){
    alert("지점을 선택해주세요");
    return false;
  }
  else if(form.tht_nm.value==""){
    alert("상영관을 선택해주세요");
    return false;
  }
  else if(form.scr_stt_time.value==""){
    alert("상영시간을 선택해주세요");
    return false;
  }
  else if(form.mv_nm.value==""){
    alert("영화를 선택해주세요");
    return false;
  }
  else{
    return true;
  }
}

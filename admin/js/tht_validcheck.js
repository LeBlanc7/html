function validcheck(){
  
  form = document.insertform;
  
  if(form.loc.value==""){
    alert("지점을 선택한 후 제출해주세요");
    return false;
  }
  else if(form.tht_nm.value==""){
    alert("상영관 이름을 입력한 후 제출해주세요");
    return false;
  } 
  else if(form.seatN.value==""){
    alert("좌석수를 선택한 후 제출해주세요");
    return false;
  }

  else{
    return true;
  }
}

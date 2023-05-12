function selectAll(selectAll)  {
  const checkboxes 
     = document.querySelectorAll('input[type="checkbox"]');
  
  checkboxes.forEach((checkbox) => {
    checkbox.checked = selectAll.checked
  })
}

function post(){
  let checkbox_checked = document.querySelectorAll('input[type="checkbox"]:checked');

  if(checkbox_checked.length == 0){
    alert('1개 이상 선택해주세요');
    return false;
  }else{
    return true;
  }
}
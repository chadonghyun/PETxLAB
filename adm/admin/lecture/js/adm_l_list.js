function selectAll(selectAll)  {
  const checkboxes 
     = document.querySelectorAll('input[type="checkbox"]');
  
  checkboxes.forEach((checkbox) => {
    checkbox.checked = selectAll.checked
  })
}

const textBox = document.getElementById('text_box');

textBox.addEventListener('keyup', function(event) {
  if (event.key === 'Enter') {
    const searchTerm = textBox.value;
    console.log('검색어:', searchTerm);
  }
});

function post(){
  let checkbox_checked = document.querySelectorAll('input[type="checkbox"]:checked');

  if(checkbox_checked.length == 0){
    alert('1개 이상 선택해주세요');
    return false;
  }else{
    return true;
  }
}
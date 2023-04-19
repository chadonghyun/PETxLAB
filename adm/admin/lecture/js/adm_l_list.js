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

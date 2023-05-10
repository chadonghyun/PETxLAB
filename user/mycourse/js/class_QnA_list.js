$(document).ready(function() {
  var $cate = $('#cate');
  var $toggle = $('#toggle');
  var $toggleIcon = $toggle.find('i');
  var isExpanded = false;
  
  $toggle.click(function() {
    if (!isExpanded) {
      $cate.animate({ height: '120px' }, 'fast');
      $toggleIcon.removeClass('bi-caret-down-fill').addClass('bi-caret-up-fill');
    } else {
      $cate.animate({ height: '40px' }, 'fast');
      $toggleIcon.removeClass('bi-caret-up-fill').addClass('bi-caret-down-fill');
    }
    isExpanded = !isExpanded;
  });
  // Get the value of 'no' parameter from the URL
  const urlParams = new URLSearchParams(window.location.search);
  const noValue = urlParams.get('no');

  // Find the corresponding 'li' element based on 'no' value
  const cateList = document.getElementById('cate');
  const listItem = cateList.querySelector(`li:nth-child(${noValue})`);

  // Move the corresponding 'li' element to the top
  cateList.prepend(listItem);
// Remove 'active' class from existing 'li' element
const activeItem = document.querySelector('.active');
activeItem.classList.remove('active');

// Add 'active' class to the moved 'li' element
listItem.classList.add('active');
});
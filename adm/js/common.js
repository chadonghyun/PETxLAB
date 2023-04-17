$(document).ready(function() {
  $('#title').text('홈');
  
  let gnb_menu = document.querySelectorAll('.header-menu li');
  let url = window.location.href;
  url = url.split("/");
  
  if(url[6] == "board"){
    gnb_menu[3].classList.add('on');
  }
});


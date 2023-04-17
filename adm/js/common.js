$(document).ready(function() {
  $('#title').text('홈');
  
  let gnb_menu = $('.header-menu li');
  let url = window.location.href;
  url = url.split("/");
  let page = url[6];

  if(page == "board"){
    $('#title').text('게시판관리')
    gnb_menu.eq(3).addClass('on')
  }else if(page == "lecture"){
    $('#title').text('강의관리')
    gnb_menu.eq(2).addClass('on')
  }else if(page == "a_index.php" || page == "t_index.php"){
    $('#title').text('홈')
    gnb_menu.eq(0).addClass('on')
  }else if(page == "member"){
    $('#title').text('회원관리')
    gnb_menu.eq(1).addClass('on')
  }
});

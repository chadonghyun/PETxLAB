$(document).ready(function() {
  $('#title').text('홈');

  $('.aaaa').click(function() {
    let linkTitle = $(this).attr('title'); // 클릭한 a 태그의 title 속성 값을 가져옴
    $('#title').text(linkTitle); // p 태그의 텍스트 내용을 가져온 title 속성 값으로 변경
    
    // 모든 a 태그의 background 색상 초기화
    $('.aaaa').css('background-color', 'transparent');
    // 클릭한 a 태그의 background 색상 변경
    $(this).css('background-color', '#9DADC7');
  });
});
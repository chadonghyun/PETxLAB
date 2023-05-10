$('#slide > li:gt(0)').hide();

setInterval(function(){
    $('#slide > li:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('#slide');
},3000);

// 강의소개 탭메뉴 구현하기
$(document).ready(function(){
  $('.tabmenu div').click(function(){
    let idx = $(this).index();
    $('.tabmenu div').removeClass('on');
    $('.tabmenu div p').removeClass('on2');
    $('.tabmenu div').eq(idx).addClass('on');
    $('.tabmenu div p').eq(idx).addClass('on2');
    $('.slide_box').hide();
    $('.slide_box').eq(idx).show();
  })
});

// 스와이퍼 슬라이드
const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  autoplay:{
    delay:6000,
    disableOnInteraction: false,
  },

  // If we need pagination
	pagination : { // 페이징 설정
		el : '.swiper-pagination',
		clickable : true, // 페이징을 클릭하면 해당 영역으로 이동, 필요시 지정해 줘야 기능 작동
    type : 'fraction', 
	},

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  // scrollbar: {
  //   el: '.swiper-scrollbar',
  // },
  
});

// 네트워크 말풍선
$('#network li:gt(0)').hide();
setInterval(function(){
    $('#network li:first')
        .fadeOut(1000)
        .next()
        .fadeIn(1000)
        .end()
        .appendTo('#network ul');
},2800);

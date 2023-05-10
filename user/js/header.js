$(function(){
  //햄버거바 클릭시 .gnb 나타나게&닫히게
  $(".mnu_bar").click(function(){
    $(".left_box").animate({left: 0}, 500);
    $('body').css('overflow','hidden');
  });
  $(".close_btn").click(function(){
    $(".left_box").animate({left: "-100%"},500);
    $('body').css('overflow','auto');
  });

  //user아이콘 클릭시 .gnb 나타나게&닫히게
  $(".user_bar").click(function(){
    $(".right_box").animate({right: 0}, 500);
    $('body').css('overflow','hidden');
  });
  $(".close_btn").click(function(){
    $(".right_box").animate({right: "-100%"},500);
    $('body').css('overflow','auto');
  });
  $(".mnu_bar").click(function(){
    $(".right_box").animate({right: "-100%"},500);
    $('body').css('overflow','hidden');
  });


  // .gnb기능
  const gnbLiList = $('.gnb > li > a');
  const lnbList = $('.lnb');

  // 첫번째 .gnb>li에 .act01 서식을 추가하고, 첫번째 .lnb를 보이게 설정
  gnbLiList.eq(0).addClass('act01');
  lnbList.eq(0).show();

  gnbLiList.on('click', function() {
    // 모든 .lnb 요소들을 숨기고 클릭한 li에 해당하는 .lnb만 보이도록 수정
    lnbList.hide();
    $(this).next('.lnb').show();

    // 모든 .gnb > li 요소들의 클래스를 초기화하고, 클릭한 li에 해당하는 클래스 추가
    gnbLiList.removeClass('act01');
    $(this).addClass('act01');
  });

  //고냥이손 기능
  // .cat_box img 선택
  const catImg = $('.cat_box img');
  catImg.css('left', '0px');

  // .gnb li 선택
  const gnbItems = $('.gnb > li');

  // gnbItems를 순회하면서 각 엘리먼트에 클릭 이벤트를 추가합니다.
  gnbItems.on('click', function() {
    // .cat_box 내부의 img 엘리먼트를 천천히 이동시키는 애니메이션을 실행합니다.
    let position = -60; // 시작 위치
    const intervalId = setInterval(() => {
      if (position >= 0) {
        clearInterval(intervalId);
      } else {
        position += 1;
        catImg.css('left', `${position}px`);
      }
    }, 10);
  });

  // lnbList의 click 이벤트에 이벤트 객체 e를 인자로 받아, e.stopPropagation()을 호출하여 이벤트 버블링을 막아줍니다.
  lnbList.on('click', 'li', function(e) {
    e.stopPropagation();
  });
  
  // .close_btn을 클릭하면 모든 요소들의 초기값으로 돌아가는 기능 추가
  $('.close_btn').on('click', function() {
    // .lnb 숨기기
    lnbList.hide();
    lnbList.eq(0).show();
    
    // .act01 클래스 제거
    gnbLiList.removeClass('act01');
    gnbLiList.eq(0).addClass('act01');
    
    // .cat_box 초기값으로 되돌리기
    catImg.css('left', '0px');
    });
});
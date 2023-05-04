$(function(){
  //햄버거바 클릭시 .gnb 나타나게
  $(".mnu_bar").click(function(){
    $(".left_box").animate({left: 0}, 500);

  });

  //닫기버튼 눌렀을때 .gnb 사라지게
  $(".close_btn").click(function(){
    $(".left_box").animate({left: "-100%"},500);
    return false;
  });

  $(".user_bar").click(function(){
    $(".right_box").animate({right: 0}, 500);
  });
  $(".close_btn").click(function(){
    $(".right_box").animate({right: "-100%"},500);
  });

  
 // 모든 .lnb 숨기기
  $(".gnb > li").click(function() {
    // 다른 .gnb>li에 있는 .act01 class를 제거
    $(".gnb > li").not(this).removeClass("act01");
    
    // 클릭된 .gnb>li에 .act01 class 추가
    $(this).addClass("act01");
    
    // 해당하는 .lnb만 보이게 수정
    var index = $(".gnb > li").index(this) + 1;
    $(".lnb").css('display','block');
    $(".lnb" + index).css('display','none');
  });
});
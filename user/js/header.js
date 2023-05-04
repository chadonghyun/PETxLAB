$(function(){
  //햄버거바 클릭시 .gnb 나타나게
  $(".mnu_bar").click(function(){
    $(".left_box").animate({left: 0}, 500);
  });


  //닫기버튼 눌렀을때 .gnb 사라기게
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

  

  
  // .gnb기능
  const gnbLiList = document.querySelectorAll('.gnb > li');
  const lnbList = document.querySelectorAll('.lnb');

  // 첫번째 .gnb>li에 .act01 서식을 추가하고, 첫번째 .lnb를 보이게 설정
  gnbLiList[0].classList.add('act01');
  lnbList[0].style.display = 'block';

  gnbLiList.forEach((gnbLi, index) => {
    gnbLi.addEventListener('click', () => {
      // 모든 .lnb 요소들을 숨기고 클릭한 li에 해당하는 .lnb만 보이도록 수정
      lnbList.forEach(lnb => {
        lnb.style.display = 'none';
        lnb.style.left = '0px'; // .lnb의 위치를 왼쪽으로 이동
      });
      lnbList[index].style.display = 'block';

      // .lnb의 위치를 왼쪽에서 오른쪽으로 이동하는 애니메이션
      let position = -50; // 시작 위치
      const intervalId = setInterval(() => {
        if (position >= 0) {
          clearInterval(intervalId);
          lnbList[index].style.left = '50%'; // 애니메이션이 끝나면 .lnb를 가운데 정렬
        } else {
          position += 1;
          lnbList[index].style.left = `${position}%`;
        }
      }, 10);
        // 모든 .gnb > li 요소들의 클래스를 초기화하고, 클릭한 li에 해당하는 클래스 추가
        gnbLiList.forEach(li => li.classList.remove('act01'));
        gnbLi.classList.add('act01');
      });
    });
  
  //고냥이손 기능
  // .cat_box img 선택
  const catImg = document.querySelector('.cat_box img');
  catImg.style.left = '0px';

  // .gnb li 선택
  const gnbItems = document.querySelectorAll('.gnb > li');

  // gnbItems를 순회하면서 각 엘리먼트에 클릭 이벤트를 추가합니다.
  gnbItems.forEach(item => {
    item.addEventListener('click', () => {
      // .cat_box 내부의 img 엘리먼트를 천천히 이동시키는 애니메이션을 실행합니다.
      let position = -60; // 시작 위치
      const intervalId = setInterval(() => {
        if (position >= 0) {
          clearInterval(intervalId);
        } else {
          position += 1;
          catImg.style.left = `${position}px`;
        }
      }, 10);
    });
  });
}); 
$(function(){
  //햄버거바 클릭시 .gnb 나타나게
  $(".mnu_bar").click(function(){
    $(".right_box").animate({left: 0}, 500);
  });

  //닫기버튼 눌렀을때 .gnb 사라기게
  $(".close_btn").click(function(){
    $(".right_box").animate({left: "-100%"},500);
  });

  
  // .gnb기능
  // const gnb = document.querySelector('.gnb');
  // const lnbList = document.querySelectorAll('.lnb');

  // // 처음에 첫번째 .lnb는 보이도록 함
  // lnbList[0].classList.add('act01');

  // gnb.addEventListener('click', function(event) {
  //   // 이벤트가 발생한 요소의 클래스에 'lnb'가 포함되어 있는지 체크
  //   if (event.target.classList.contains('lnb')) {
  //     // 클릭한 요소가 lnb이면 아무 동작하지 않음
  //     return;
  //   }

  //   // 클릭한 요소의 부모 li 요소를 찾음
  //   const clickedLi = event.target.closest('li');

  //   // 부모 li 요소에 active 클래스 추가
  //   clickedLi.classList.add('act01');

  //   // 나머지 li 요소에서 active 클래스 제거
  //   const siblings = Array.from(clickedLi.parentNode.children);
  //   siblings.forEach((sibling) => {
  //     if (sibling !== clickedLi) {
  //       sibling.classList.remove('act01');
  //     }
  //   });

  //   // 클릭한 li 요소의 자식 .lnb 요소 보이게 함
  //   const lnb = clickedLi.querySelector('.lnb');
  //   lnb.classList.add('act01');

  //   // 나머지 .lnb 요소는 숨김
  //   lnbList.forEach((lnbItem) => {
  //     if (lnbItem !== lnb) {
  //       lnbItem.classList.remove('act01');
  //     }
  //   });

  //   // 선택되지 않은 .gnb>li에 있는 .lnb는 숨김
  //   const siblingsLi = Array.from(clickedLi.parentNode.children);
  //   siblingsLi.forEach((sibling) => {
  //     if (sibling !== clickedLi) {
  //       const siblingLnb = sibling.querySelector('.lnb');
  //       siblingLnb.classList.remove('act01');
  //     }
  //   });
  // });

  // 첫번째 .lnb는 무조건 보이도록 초기화
  document.querySelector('.lnb:first-of-type').style.display = 'block';

  const gnbLiList = document.querySelectorAll('.gnb > li');
  gnbLiList.forEach((gnbLi, index) => {
    gnbLi.addEventListener('click', () => {
      // 모든 .lnb 요소들을 숨기고 클릭한 li에 해당하는 .lnb만 보이도록 수정
      const lnbList = document.querySelectorAll('.lnb');
      lnbList.forEach(lnb => lnb.style.display = 'none');
      const lnbToShow = document.querySelector(`.lnb:nth-of-type(${index+1})`);
      if (lnbToShow) {
        lnbToShow.style.display = 'block';
      }
      
      // 모든 .gnb > li 요소들의 클래스를 초기화하고, 클릭한 li에 해당하는 클래스 추가
      gnbLiList.forEach(li => li.classList.remove('act01'));
      gnbLi.classList.add('act01');
    });
  });
}); 
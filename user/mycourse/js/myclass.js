const tabs = document.querySelectorAll(".tabs .tab");
const tabListItems = document.querySelectorAll(".qna_tab_list li");

function switchTab(event) {
  // 선택된 탭의 데이터 탭 속성 값 가져오기
  const selectedTab = event.currentTarget.getAttribute("data-tab");

  // 선택된 탭의 인덱스에 맞는 탭 내용 보여주기
  tabs.forEach(tab => {
    if (tab.getAttribute("data-tab") === selectedTab) {
      tab.style.display = "block";
    } else {
      tab.style.display = "none";
    }
  });

  // 선택된 탭 스타일 변경
  tabListItems.forEach(item => {
    if (item.getAttribute("data-tab") === selectedTab) {
      item.classList.add("active");
    } else {
      item.classList.remove("active");
    }
  });
}

// 첫 번째 탭을 초기값으로 설정하고 해당 탭 내용 보여주기
tabs.forEach((tab, index) => {
  tab.style.display = index === 0 ? "block" : "none";
});

// 각 탭 클릭 시 switchTab 함수 실행
tabListItems.forEach(item => {
  item.addEventListener("click", switchTab);
});

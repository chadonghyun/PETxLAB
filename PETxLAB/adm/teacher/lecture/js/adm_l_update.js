// flatpicker로 start-date와 end-date 요소에 date picker를 적용
flatpickr("#course_startday", {});

// course_startday와 course_endday 값이 변경되면 강의 기간을 계산하여 duration-input 요소에 출력
document.getElementById("course_startday").addEventListener("change", function() {
  // course_startday 변경 시 end-date의 minDate 변경
  const minEndDate = new Date(this.value); // course_startday 선택된 날짜
  flatpickr("#course_endday", { minDate: minEndDate });
  updateDuration();
});

document.getElementById("course_endday").addEventListener("change", function() {
  updateDuration();
});


function updateDuration() {
  const startDate = new Date(document.getElementById("course_startday").value);
  const endDate = new Date(document.getElementById("course_endday").value);
  const duration = Math.round((endDate.getTime() - startDate.getTime()) / (1000 * 60 * 60 * 24));
  document.getElementById("course_duration").value = duration + "일";
}

// 강의금액 입력하기
// const priceInput = document.getElementById('course_price');
// priceInput.addEventListener('input', function(event) {
//   // 입력된 값에서 숫자만 추출
//   const price = event.target.value.replace(/[^0-9]/g, '');
  
//   // 숫자를 3자리씩 콤마로 구분하여 문자열로 변환함
//   const formattedPrice = Number(price).toLocaleString();
  
//   // 변환된 문자열 뒤에 '원'이라는 글자를 추가하여 입력란에 출력한다 ,... 
//   event.target.value = formattedPrice + '원';
// });

// 이미지 업데이트
// 이미지 업로드 버튼 클릭 시 파일 선택 창 띄우기
$("#update-image-btn").click(function() {
  $("#course-image").click();
});

// 파일 선택 시 파일 이름과 이미지 미리보기 출력
$("#course-image").change(function() {
  var file = this.files[0];
  if (file) {
    var reader = new FileReader();
    reader.onload = function(event) {
      $("#image-preview").html("<img src='" + event.target.result + "' class='img-fluid'>");
    }
    reader.readAsDataURL(file);
    $("#image-label").text(file.name);
  } else {
    $("#image-preview").empty();
    $("#image-label").text("이미지 파일 선택");
  }
});

// 옵션 선택에 따른 
function course(e){
  let pro = ["펫테이너 전문과정","프로매니저 전문과정","반려동물 전문창업과정","반려동물 행동교정사","반려동물 식품관리사"];
  let gen =["펫푸드","펫미용","펫아이템","행동교정","펫베이커리"];
  let target = document.getElementById("course_category");


  if(e.value == "professional") var list = pro;
  else if(e.value == "general") var list = gen;

  console.log(list);

  target.options.length = 0;

  for (x in list) {
    var opt = document.createElement("option");
    opt.value = list[x];
    opt.innerHTML = list[x];
    target.appendChild(opt);
  }
}
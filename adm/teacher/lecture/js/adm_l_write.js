// flatpicker로 start-date와 end-date 요소에 date picker를 적용
flatpickr("#course_startday", {});

let start = document.getElementById("course_startday");
let end = document.getElementById("course_endday");

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

  // check if start date and end date are valid
  if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
    document.getElementById("course_duration").value = "";
    return;
  }

  let duration = Math.round((endDate.getTime() - startDate.getTime()) / (1000 * 60 * 60 * 24));
  if (duration < 0) {
    duration = 0;
  }

  document.getElementById("course_duration").value = "0"+ duration + "일";
}



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
  let pro = ["반려동물 전문창업","반려동물 행동교정사","반려동물 식품관리사","펫 유치원 식품관리사","펫 유치원 교원사","펫 뷰티션","반려동물장례코디네이터","반려동물관리사","동물병원코디네이터","펫시터"];
  let gen =["펫푸드","펫미용","펫아이템","행동교정"];
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

// 동영상,학습자료 업데이트 하기


   // HTML 요소가 로드된 후 실행되는 함수
    window.addEventListener('DOMContentLoaded', function() {
    // 버튼 클릭 시 input 태그 작동 및 보이지 않게 설정
    document.getElementById('upload-btn').addEventListener('click', function(event) {
      event.preventDefault(); // 폼 제출 기본 동작 막기
      document.getElementById('file-input').click();
    });
  });



  const handler = {
    fileCount: 0,
  
    init() {
      const fileInput = document.querySelector('#file-input');
      const preview = document.querySelector('#preview');
      fileInput.addEventListener('change', () => {
        const files = Array.from(fileInput.files);
        files.forEach((file, index) => {
          this.fileCount++;
          const fileId = `${file.lastModified}-${this.fileCount}`;
          preview.innerHTML += `
            <ul class="content_Box">
              <li>
                <p id="${fileId}" class="number">
                  <span>${this.fileCount}.</span>${file.name}
                  <button data-index='${fileId}' class='file-remove'><span class="x">X</span></button>
                </p>
              </li>
            </ul>
          `;
        });
      });
  
      this.removeFile();
    },
  
    removeFile() {
      document.addEventListener('click', (e) => {
        if (e.target.className !== 'file-remove' && e.target.parentElement.className !== 'file-remove') return;
        let removeTargetId;
        if (e.target.className === 'file-remove') {
          removeTargetId = e.target.dataset.index;
        } else if (e.target.parentElement.className === 'file-remove') {
          removeTargetId = e.target.parentElement.dataset.index;
        }
        const removeTarget = document.getElementById(removeTargetId);
        const files = document.querySelector('#file-input').files;
        const dataTransfer = new DataTransfer();
  
        Array.from(files)
          .filter(file => `${file.lastModified}-${this.fileCount}` !== removeTargetId)
          .forEach(file => {
            dataTransfer.items.add(file);
          });
  
        document.querySelector('#file-input').files = dataTransfer.files;
  
        removeTarget.remove();
      });
    }
  };
  
  handler.init();
  
  

  // HTML 요소가 로드된 후 실행되는 함수
  window.addEventListener('DOMContentLoaded', function() {
    // 버튼 클릭 시 input 태그 작동 및 보이지 않게 설정
    document.getElementById('upload-btn2').addEventListener('click', function(event) {
      event.preventDefault(); // 폼 제출 기본 동작 막기
      document.getElementById('file-input2').click();
    });
  });
  
  const handler2 = {
    count: 0,
  
    init() {
      const fileInput = document.querySelector('#file-input2');
      const preview = document.querySelector('#preview2');
      fileInput.addEventListener('change', () => {
        const files = Array.from(fileInput.files);
        files.forEach((file, index) => {
          this.count++;
          const fileId = `${file.lastModified}-${this.count}`;
          preview.innerHTML += `
            <ul class="content_Box">
              <li>
                <p id="${file.lastModified}" class="number"><span>${this.count}.</span>${file.name}<button data-index='${file.lastModified}' class='file-remove2'><span class="x">X</span></button></p>
              </li>
            </ul>
          `;
        });
      });
  
      this.removeFile2();
    },
  
    removeFile2() {
      document.addEventListener('click', (e) => {
        if (e.target.className !== 'file-remove2' && e.target.parentElement.className !== 'file-remove2') return;
        let removeTargetId2;
        if (e.target.className === 'file-remove2') {
          removeTargetId2 = e.target.dataset.index;
        } else if (e.target.parentElement.className === 'file-remove2') {
          removeTargetId2 = e.target.parentElement.dataset.index;
        }
        const removeTarget2 = document.getElementById(removeTargetId2);
        const files = document.querySelector('#file-input2').files;
        const dataTransfer2 = new DataTransfer();
  
        Array.from(files)
          .filter(file => file.lastModified != removeTargetId2)
          .forEach(file => {
            dataTransfer2.items.add(file);
          });
  
        document.querySelector('#file-input2').files = dataTransfer2.files;
  
        removeTarget2.remove();
      });
    }
  };
  
  handler2.init();
  


  

  
  


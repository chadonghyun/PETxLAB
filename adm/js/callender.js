$(document).ready(function() {
  calendarInit();
});

function calendarInit() {
  let date = new Date();
  let utc = date.getTime() + (date.getTimezoneOffset() * 60 * 1000);
  let kstGap = 9 * 60 * 60 * 1000;
  let today = new Date(utc + kstGap);
  let thisMonth = new Date(today.getFullYear(), today.getMonth(), today.getDate());

  let currentYear = thisMonth.getFullYear();
  let currentMonth = thisMonth.getMonth();
  let currentDate = thisMonth.getDate();

  renderCalendar(thisMonth);

  function renderCalendar(thisMonth) {
    currentYear = thisMonth.getFullYear();
    currentMonth = thisMonth.getMonth();
    currentDate = thisMonth.getDate();

    let startDay = new Date(currentYear, currentMonth, 0);
    let prevDate = startDay.getDate();
    let prevDay = startDay.getDay();

    let endDay = new Date(currentYear, currentMonth + 1, 0);
    let nextDate = endDay.getDate();
    let nextDay = endDay.getDay();

    $('.year-month').text(currentYear + '.' + (currentMonth + 1));

    let calendar = document.querySelector('.dates')
    calendar.innerHTML = '';

        for (let i = prevDate - prevDay + 1; i <= prevDate; i++) {
          calendar.innerHTML += '<div class="day prev disable" data-date="'+currentYear + '-' + (currentMonth < 10 ? '0'+(currentMonth) : currentMonth+1)+ '-' + (i < 10 ? '0'+i : i) +'">' + i + '</div>';
        }
    
        for (let i = 1; i <= nextDate; i++) {
          calendar.innerHTML += '<div class="day current" data-date="'+currentYear + '-' + (currentMonth+1 < 10 ? '0'+(currentMonth+1) : currentMonth+1)+ '-' + (i < 10 ? '0'+i : i) +'">' + i + '</div>';
        }
    
        for (let i = 1; i <= (7 - nextDay == 7 ? 0 : 7 - nextDay); i++) {
          calendar.innerHTML += '<div class="day next disable" data-date="'+currentYear + '-' + (currentMonth+2 < 10 ? '0'+(currentMonth+2) : currentMonth+1)+ '-' + (i < 10 ? '0'+i : i) +'">' + i + '</div>';
        }
    
        if (today.getMonth() == currentMonth) {
          let todayDate = today.getDate();
          let currentMonthDate = document.querySelectorAll('.dates .current');
          currentMonthDate[todayDate -1].classList.add('today');
        }
        courseDataInsert();
  }

  $('.go-prev').on('click', function() {
    thisMonth = new Date(currentYear, currentMonth - 1, 1);
    renderCalendar(thisMonth);
  });

  $('.go-next').on('click', function() {
    thisMonth = new Date(currentYear, currentMonth + 1, 1);
    renderCalendar(thisMonth); 
  });

  function courseDataInsert(){
      // coursereg 테이블에서 start_date와 end_date 가져오기
        let startDates = [];
        let endDates = [];
        let course_data = [];
      $.getJSON('coursereg.php', function(data) {
        $.each(data, function(key, value) {
          startDates.push(value.course_startday);
          endDates.push(value.course_endday);
          course_data.push(value);
        });
  
        // start_date와 end_date를 파란색으로 표시
        for (let i = 0; i < startDates.length; i++) {
          let start = new Date(startDates[i]);
          let end = new Date(endDates[i]);
  
          let current = new Date(start);
  
          while (current <= end) {
            let year = current.getFullYear();
            let month = current.getMonth();
            let day = current.getDate();
  
            $('.dates .current').each(function() {
              if ($(this).text() == day && currentMonth == month && currentYear == year) {
                $(this).addClass('course');
              }
            });
  
            current.setDate(current.getDate() + 1);
          }
        }

        // 해당 월에만 course_title 뽑아오기
      $('.day').each(function(){
        for(let i = 0; i < course_data.length; i++){
          if(course_data[i].course_startday == $(this).data('date')){
            let course_title = course_data[i].course_title;
            let course_month = new Date(course_data[i].course_startday).getMonth();
            if (course_month == currentMonth && currentYear == new Date(course_data[i].course_startday).getFullYear()) {
              $(this).html($(this).html()+'<div class=txt01>'+course_title+'</div>');
            }
          }
        }
      });
    });
  }
}

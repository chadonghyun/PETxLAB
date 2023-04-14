$(document).ready(function() {
  calendarInit();
});

function calendarInit() {
  var date = new Date();
  var utc = date.getTime() + (date.getTimezoneOffset() * 60 * 1000);
  var kstGap = 9 * 60 * 60 * 1000;
  var today = new Date(utc + kstGap);
  var thisMonth = new Date(today.getFullYear(), today.getMonth(), today.getDate());

  var currentYear = thisMonth.getFullYear();
  var currentMonth = thisMonth.getMonth();
  var currentDate = thisMonth.getDate();

  renderCalendar(thisMonth);

  function renderCalendar(thisMonth) {
    currentYear = thisMonth.getFullYear();
    currentMonth = thisMonth.getMonth();
    currentDate = thisMonth.getDate();

    var startDay = new Date(currentYear, currentMonth, 0);
    var prevDate = startDay.getDate();
    var prevDay = startDay.getDay();

    var endDay = new Date(currentYear, currentMonth + 1, 0);
    var nextDate = endDay.getDate();
    var nextDay = endDay.getDay();

    $('.year-month').text(currentYear + '.' + (currentMonth + 1));

    var calendar = document.querySelector('.dates')
    calendar.innerHTML = '';

    for (var i = prevDate - prevDay + 1; i <= prevDate; i++) {
      calendar.innerHTML += '<div class="day prev disable">' + i + '</div>';
    }

    for (var i = 1; i <= nextDate; i++) {
      calendar.innerHTML += '<div class="day current">' + i + '</div>';
    }

    for (var i = 1; i <= (7 - nextDay == 7 ? 0 : 7 - nextDay); i++) {
      calendar.innerHTML += '<div class="day next disable">' + i + '</div>';
    }

    if (today.getMonth() == currentMonth) {
      var todayDate = today.getDate();
      var currentMonthDate = document.querySelectorAll('.dates .current');
      currentMonthDate[todayDate -1].classList.add('today');
    }

        // 추가된 코드 시작
        var startDates = [];
        var endDates = [];
    
        // coursereg 테이블에서 start_date와 end_date 가져오기
        $.getJSON('coursereg.php', function(data) {
          $.each(data, function(key, value) {
            startDates.push(value.course_startday);
            endDates.push(value.course_endday);
          });
    
          // start_date와 end_date를 파란색으로 표시
          for (var i = 0; i < startDates.length; i++) {
            var start = new Date(startDates[i]);
            var end = new Date(endDates[i]);
    
            var current = new Date(start);
    
            while (current <= end) {
              var year = current.getFullYear();
              var month = current.getMonth();
              var day = current.getDate();
    
              $('.dates .current').each(function() {
                if ($(this).text() == day && currentMonth == month && currentYear == year) {
                  $(this).addClass('course');
                }
              });
    
              current.setDate(current.getDate() + 1);
            }
          }
        });

  }

  $('.go-prev').on('click', function() {
    thisMonth = new Date(currentYear, currentMonth - 1, 1);
    renderCalendar(thisMonth);
  });

  $('.go-next').on('click', function() {
    thisMonth = new Date(currentYear, currentMonth + 1, 1);
    renderCalendar(thisMonth); 
  });
}

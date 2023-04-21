<?php

include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/db/db_con.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

// 전체 회원 수
$sql = "SELECT COUNT(*) as total FROM userregistration";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$total_members = $row['total'];

// QNA 미응답
$sql = "SELECT COUNT(*) as count_response
        FROM boardqnareg
        WHERE qna_response = 0
        AND course_id IN (
            SELECT course_id FROM coursereg WHERE user_id = '{$userid}'
        )
        ";

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$count_unanswered = $row["count_response"];


// 회원번호
$sql = "SELECT * FROM userregistration WHERE user_id = '$userid'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
$num = sprintf("%04d", $user['number']);

//전체 강의
$sql = "SELECT COUNT(*) FROM coursereg WHERE user_id='$userid'";
$result = mysqli_query($con, $sql);
$lecture_count = mysqli_fetch_array($result)[0];

//전체 수강생
$sql = "SELECT COUNT(ur.course_id) 
        FROM userregistration ur 
        INNER JOIN coursereg cr ON ur.course_id = cr.course_id 
        WHERE cr.user_id = '$userid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$total_count = $row[0];


//공지사항
//게시판 정보를 가져옴
$sql1 = "SELECT * FROM boardnoticereg ORDER BY Board_date DESC LIMIT 3";
$result1 = mysqli_query($con, $sql1);

?>
<link rel="stylesheet" href="../css/index.css">
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- fullcalendar 언어 CDN -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/locales-all.min.js'></script>
<script src="../js/callender.js"></script>

<main>

  <section id="main">
    <div class="a_container1">
      <form action="" method="post">
        <div class="a_profile">
          <div class="p_img">
            <img src="../images/logo.png" alt="">
          </div>
          <div class="p_num">
            <h6>회원번호</h6>
            <p>
              <?php echo "$num"?>
            </p>
          </div>
          <div class="p_name">
            <h6>이름</h6>
            <p><?php echo "$username"?></p>
          </div>
          <div class="p_id">
            <h6>아이디</h6>
            <p><?php echo "$userid"?></p>
          </div>
          <button type="submit">정보수정</button>
        </div>
      </form>
    </div>
    <div class="a_container2 a_container2_1">
      <div class="item1 a_status">
        <h3>사이트 현황</h3>
        <div>
          <p>신규수강생</p>
          <p>
            <span>아직모름</span>
            명
          </p>
        </div>
        <div>
          <p>전체수강생</p>
          <p>
            <span>
              <?php 
                echo "$total_count"
              ?>
            </span>
            명
          </p>
        </div>        
        <div>
          <p>QnA 미응답</p>
          <p>
            <span>
              <?php 
                echo "$count_unanswered";
              ?>
            </span>
            개
          </p>
        </div>       
        <div>
          <p>전체강의</p>
          <p>
            <span>
              <?php echo "$lecture_count"?>
            </span>
            개
          </p>
        </div>
      </div>
      <div class="item1 a_board">
        <h3>공지사항</h3>
        <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/teacher/board/tch_b_list.php?no=1" title="종합 게시판 바로가기">공지사항 바로가기</a>
        <table>
          <tbody>
            <?php
              while($row = mysqli_fetch_assoc($result1)) {
                $num = sprintf("%03d", $row['number']);
                $type = $row['Board_content'];
                $title = $row['Board_title'];
                $date = substr($row['Board_date'],0,10);
                echo "<tr><td>$num</td><td>$type</td><td class='b_title'><a href='board/tch_b_view.php?idx=".$row['number']."'>$title</a></td><td>$date</td></tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
      <div class="item1 a_board">
        <h3>QnA 게시판</h3>
        <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/teacher/board/tch_b_list.php?no=1" title="종합 게시판 바로가기">QnA 게시판 바로가기</a>
        <table>
          <tbody>
            <?php
              $sql4 = "SELECT course_id FROM coursereg WHERE user_id = '$userid'";
              $sql = "SELECT qna_title, Board_date, qna_category, number FROM boardqnareg WHERE course_id IN ($sql4) ORDER BY Board_date DESC LIMIT 3";
              $result3 = mysqli_query($con, $sql);

              if ($result3) {
                while ($row2 = mysqli_fetch_assoc($result3)) {
                  echo "<tr><td>" . sprintf("%03d", $row2['number']) . "</td>";
                  echo "<td>" . $row2['qna_category'] . "</td>";
                  echo "<td class='b_title'>" . $row2['qna_title'] . "</td>";
                  echo "<td>" . substr($row2['Board_date'], 0, 10) . "</td></tr>";
                }
              } else {
                echo "쿼리 실행 실패";
              }
            ?>
          </tbody>
        </table>
      </div>

      <?php
      $sql = "SELECT course_startday, course_endday FROM coursereg";
      $result = mysqli_query($con, $sql);

      echo '<div class="item1 a_callender">';
      echo '<div class="sec_cal">';
      echo '<div class="cal_nav">';
      echo '<a href="javascript:;" class="nav-btn go-prev">prev</a>';
      echo '<div class="year-month"></div>';
      echo '<a href="javascript:;" class="nav-btn go-next">next</a>';
      echo '</div>';
      echo '<div class="cal_wrap">';
      echo '<div class="days">';
      echo '<div class="day">월</div>';
      echo '<div class="day">화</div>';
      echo '<div class="day">수</div>';
      echo '<div class="day">목</div>';
      echo '<div class="day">금</div>';
      echo '<div class="day">토</div>';
      echo '<div class="day">일</div>';
      echo '</div>';
      echo '<div class="dates">';
      
      // 달력의 각 날짜마다 강의 기간이 있는지 확인하여 출력
      // $current_date = date('Y-m-d');
      // while($row = mysqli_fetch_assoc($result)) {
      //   $start_date = $row["course_startday"];
      //   $end_date = $row["course_endday"];
      
      //   $current = strtotime($start_date);
      //   $end = strtotime($end_date);
        
      //   while ($current <= $end) {
      //     $date = date('Y-m-d', $current);
      //     $class = ($current_date == $date) ? 'today' : '';
      //     echo '<div class="date ' . $class . '">' . date('d', $current) . '</div>';
      //     $current = strtotime('+1 day', $current);
      //   }
      // }
      
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';

    ?>

    </div>  
  </section>
</main>

<script>
  // events[
  //         $.ajax({
  //           type:"GET",
  //           url: "./coursereg.php",
  //           data: "{}",
  //           success: function (response){
  //             result = response.result
  //             for (i = 0; i < result.length; i++){
  //               calendar.addEventListener({
  //                 title: result[i]['course_title'],
  //                 start: result[i]['course_startday'],
  //                 end: result[i]['course_endday']
  //               })
  //             }
  //           }
  //         })
  //       ]
</script>

</body>
</html>
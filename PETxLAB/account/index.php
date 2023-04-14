<?php

include_once './db/db_con.php';
include_once './config.php';
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/account/header.php";

// userregistration 테이블에서 전체 회원 수를 가져옴
$sql = "SELECT COUNT(*) as total FROM userregistration";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$total_members = $row['total'];

// 로그인 로그 테이블에서 하루 전부터 현재까지 로그인한 사용자 수를 구함
$sql = "SELECT COUNT(DISTINCT user_num) AS count FROM loginlog WHERE login_time BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

// 현재 로그인한 사용자의 번호를 가져옴
$sql = "SELECT * FROM userregistration WHERE user_id = '$userid'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
$num = sprintf("%04d", $user['number']);

//게시판 정보를 가져옴
$sql = "SELECT * FROM coursereg ORDER BY course_id DESC LIMIT 5";
$result = mysqli_query($con, $sql);

?>
<!-- <link rel="stylesheet" href="./css/index.css">
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- fullcalendar 언어 CDN -->
<!-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/locales-all.min.js'></script>
<script src="./script/callender.js"></script> -->

<main>

  <section id="main">
    <div class="a_container1">
      <form action="" method="post">
        <div class="a_profile">
          <div class="p_img">
            <img src="./images/logo.png" alt="">
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
    <div class="a_container2">
      <div class="a_status">
        <h3>사이트 현황</h3>
        <div>
          <p>신규회원</p>
          <p>
            <span>200</span>
            명
          </p>
        </div>
        <div>
          <p>전체회원</p>
          <p>
            <span>
              <?php echo "$total_members"?>
            </span>
            명
          </p>
        </div>        
        <div>
          <p>접속자</p>
          <p>
            <span><?php echo "$count"?></span>
            명
          </p>
        </div>       
        <div>
          <p>전체강의</p>
          <p>
            <span>200</span>
            명
          </p>
        </div>
      </div>
      <div class="a_board">
        <h3>종합 게시판</h3>
        <a href="#none" title="종합 게시판 바로가기">종합 게시판 바로가기</a>
        <table>
          <tbody>
            <?php

              while($row = mysqli_fetch_assoc($result)) {
                $num = sprintf("%03d", $row['course_id']);
                $type = $row['course_type'];
                $title = $row['course_title'];
                $startday = $row['course_startday'];
                echo "<tr><td>$num</td><td>$type</td><td>$title</td><td>$startday</td></tr>";
              }
            ?>
          </tbody>
          <!-- <tbody>
            <tr>
              <td>210</td>
              <td>게시판1</td>
              <td>전문교육과정 공지사항입니다.</td>
              <td>2000.20.20</td>
            </tr>
            <tr>
              <td>210</td>
              <td>게시판1</td>
              <td>전문교육과정 공지사항입니다.</td>
              <td>2000.20.20</td>
            </tr>
            <tr>
              <td>210</td>
              <td>게시판1</td>
              <td>전문교육과정 공지사항입니다.</td>
              <td>2000.20.20</td>
            </tr>
            <tr>
              <td>210</td>
              <td>게시판1</td>
              <td>전문교육과정 공지사항입니다.</td>
              <td>2000.20.20</td>
            </tr>
            <tr>
              <td>210</td>
              <td>게시판1</td>
              <td>전문교육과정 공지사항입니다.</td>
              <td>2000.20.20</td>
            </tr>
          </tbody> -->
        </table>
      </div>

      <?php
  $sql = "SELECT course_startday, course_endday FROM coursereg";
  $result = $con->query($sql);

  echo '<div class="a_callender">';
  echo '<div class="sec_cal">';
  echo '<div class="cal_nav">';
  echo '<a href="javascript:;" class="nav-btn go-prev">prev</a>';
  echo '<div class="year-month"></div>';
  echo '<a href="javascript:;" class="nav-btn go-next">next</a>';
  echo '</div>';
  echo '<div class="cal_wrap">';
  echo '<div class="days">';
  echo '<div class="day">MON</div>';
  echo '<div class="day">TUE</div>';
  echo '<div class="day">WED</div>';
  echo '<div class="day">THU</div>';
  echo '<div class="day">FRI</div>';
  echo '<div class="day">SAT</div>';
  echo '<div class="day">SUN</div>';
  echo '</div>';
  echo '<div class="dates">';
  
  // 달력의 각 날짜마다 강의 기간이 있는지 확인하여 출력
  $current_date = date('Y-m-d');
  while($row = $result->fetch_assoc()) {
    $start_date = $row["course_startday"];
    $end_date = $row["course_endday"];
  
    $current = strtotime($start_date);
    $end = strtotime($end_date);
    
    while ($current <= $end) {
      $date = date('Y-m-d', $current);
      $class = ($current_date == $date) ? 'today' : '';
      echo '<div class="date ' . $class . '">' . date('d', $current) . '</div>';
      $current = strtotime('+1 day', $current);
    }
  }
  
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
?>

    </div>  
  </section>
</main>

</body>
</html>
<?php
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/db/db_con.php";
include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
include $_SERVER['DOCUMENT_ROOT']."/PETxLAB/adm/header.php";

//전체 회원 수
$sql = "SELECT COUNT(*) as total FROM userregistration";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$total_members = $row['total'];

// 접속자
$sql = "SELECT COUNT(DISTINCT user_num) AS count FROM loginlog WHERE login_time BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

//신규회원수
$three_days_ago = date('Y-m-d H:i:s', strtotime('-3 days'));
$sql = "SELECT COUNT(*) as total FROM userregistration WHERE regist_time >= '$three_days_ago'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$total_new_members = $row['total'];

// 회원번호
$sql = "SELECT * FROM userregistration WHERE user_id = '$userid'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
$num = sprintf("%04d", $user['number']);

//전체 강의 개수
$sql = "SELECT COUNT(*) as count FROM coursereg";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$count_course = $row['count'];

//게시판 정보를 가져옴
$sql = "SELECT * FROM boardnoticereg ORDER BY Board_date DESC LIMIT 5";
$result = mysqli_query($con, $sql);
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
      <div class="item a_status">
        <h3>사이트 현황</h3>
        <div>
          <p>신규회원</p>
          <p>
            <span>
              <?php echo "$total_new_members"?>
            </span>
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
            <span>
              <?php echo "$count"?>
            </span>
            명
          </p>
        </div>       
        <div>
          <p>전체강의</p>
          <p>
            <span><?php echo "$count_course"?></span>
            개
          </p>
        </div>
      </div>
      <div class="item a_board">
        <h3>종합 게시판</h3>
        <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/adm/admin/board/adm_b_list.php?no=1" title="종합 게시판 바로가기">종합 게시판 바로가기</a>
        <table>
          <tbody>
            <?php
              while($row = mysqli_fetch_assoc($result)) {
                $num = sprintf("%03d", $row['number']);
                // $type = $row['Board_content'];
                $title = $row['Board_title'];
                $date = substr($row['Board_date'],0,10);
                echo "<tr><td>$num</td><td class='b_title'><a href='board/adm_b_view.php?idx=".$row['number']."'>$title</a></td><td>$date</td></tr>";
              }
            ?>
          </tbody>
        </table>
      </div>

      <?php
      $sql = "SELECT course_startday, course_endday FROM coursereg";
      $result = $con->query($sql);

      echo '<div class="item a_callender">';
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
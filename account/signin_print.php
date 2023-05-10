
<?php
  include_once '../db/db_con.php';
  include_once '../config.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

  $sql = "select * from userregistration where user_id='$user_id'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);

  $email_parts = explode('@', $row['user_email']);
  $email_id = isset($email_parts[0]) ? $email_parts[0] : '';
  $email_domain = isset($email_parts[1]) ? $email_parts[1] : '';
?>


  <main>
    <h2>My page</h2>
    <div class="container">
      <form action="info_update.php" method="post" id="member_form" name="회원가입">
        <div class="con">
          <label for="name">이름</label>
          <input type="text" id="name" name="user_name" placeholder="<?=$row['user_name']?>" readonly>
        </div>
        <div class="con">
          <label for="id">아이디</label>
          <input type="text" id="id" name="user_id" placeholder="<?=$row['user_id']?>" readonly>
          <span id="id_check_msg" data-check = "0"></span>
        </div>
        <!-- <div class="con">
          <label for="password">비밀번호</label>
          <input type="password" id="password" name="user_pass" placeholder="&#x25CF;&#x25CF;&#x25CF;&#x25CF;" readonly>
        </div>
        <div class="con">
          <label for="confirm_password">비밀번호 확인</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="&#x25CF;&#x25CF;&#x25CF;&#x25CF;" readonly>
        </div> -->
        <div class="con birth">
          <label for="birthday">생년월일</label>
          <input type="number" name="user_birth_year" id="birthyear" min="1900" maxlength="4" oninput="maxLengthCheck(this)" placeholder="<?=$row['user_birth_year']?>" readonly>
          <input type="number" name="user_birth_month" id="birthmonth" min="1" maxlength="2" oninput="maxLengthCheck(this)" placeholder="<?=$row['user_birth_month']?>" readonly>
          <input type="number" name="user_birth_day" id="birthdate" min="1" maxlength="2" oninput="maxLengthCheck(this)" placeholder="<?=$row['user_birth_day']?>" readonly>
        </div>
        <div class="con phone">
          <label for="phone">연락처</label>
          <input type="text" name="phone_first" id="phone_first" maxlength="3" oninput="maxLengthCheck(this)" placeholder="<?=substr($row['user_phone'], 0, -8)?>" readonly>
          -
          <input type="number" name="phone_mid" id="phone_mid" placeholder="<?=substr($row['user_phone'], -8, 4)?>" maxlength="4" oninput="maxLengthCheck(this)" readonly>
          -
          <input type="number" name="phone_last" id="phone_last" placeholder="<?=substr($row['user_phone'], -4, 4)?>" maxlength="4" oninput="maxLengthCheck(this)" readonly>
        </div>
        <div class="con tell">
          <label for="telephone">전화번호</label>
          <input name="telephone_first" id="telephone_first" placeholder="<?=substr($row['user_telephone'], 0, -8)?>" readonly>
          -
          <input type="number" name="telephone_mid" id="telephone_mid" placeholder="<?=substr($row['user_telephone'], -8, 4)?>" min="0" maxlength="4" oninput="maxLengthCheck(this)" readonly>
          -
          <input type="number" name="telephone_last" id="telephone_last" placeholder="<?=substr($row['user_telephone'], -4, 4)?>" min="0" maxlength="4" oninput="maxLengthCheck(this)" readonly>

        </div>
        <div class="con email">
          <label for="email">이메일</label>
          <input type="text" name="email_id" id="email_id" placeholder="<?=$email_id?>" readonly>
          <span>@</span>
          <input name="email_domain" id="email_domain" placeholder="<?=$email_domain?>" readonly>
        <div class="con addr">
          <label for="address">주소</label>
          <input type="text" id="addr1" name="user_addr1" placeholder="<?=$row['user_addr1']?>" readonly>
          <input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기">
          <input type="text" id="addr2" name="user_addr2" placeholder="<?=$row['user_addr2']?>" readonly>
          <input type="text" id="addr3" name="user_addr3" placeholder="<?=$row['user_addr3']?>" readonly>
        </div>
        <div class="con job">
          <label for="job">직업</label>
          <input type="text" id="job" name="user_job" placeholder="<?=$row['user_job']?>" readonly>
        </div>
        <div class="con interest">
          <label for="interest">관심분야</label>
          <input placeholder="<?=$row['extra2']?>" readonly>
        </div>
        <div class="edit_frm">
          <button type="submit" id="edit_frm">수정하기</button>
        </div>
      </form>
    </div>
  </main>

  <script>
    $(function(){
        //수정하기 누르면 수정페이지로 넘어가기
        $('#edit_frm').click(function(){
          location.href = '<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/account/info_update.php';
        });
      });
  </script>

<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>

<?php
  include_once $_SERVER['DOCUMENT_ROOT'].'/PETxLAB/db/db_con.php';
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/config.php";
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/header.php";

  $sql = "select * from userregistration where user_id='$user_id'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);

  $email_parts = explode('@', $row['user_email']);
  $email_id = isset($email_parts[0]) ? $email_parts[0] : '';
  $email_domain = isset($email_parts[1]) ? $email_parts[1] : '';
?>


  <main>
    <h2>내정보 수정</h2>
    <div class="container">
      <form action="member_update.php" method="post" id="member_form" name="회원가입">
        <div class="con">
          <label for="name">이름</label>
          <input type="text" id="name" name="user_name" value="<?=$row['user_name']?>">
        </div>
        <div class="con">
          <label for="id">아이디</label>
          <input type="text" id="id" name="user_id" value="<?=$row['user_id']?>" readonly>
          <span id="id_check_msg" data-check = "0"></span>
        </div>
        <div class="con">
          <label for="password">비밀번호</label>
          <input type="password" id="password" name="user_pass" value="">
        </div>
        <div class="con">
          <label for="confirm_password">비밀번호 확인</label>
          <input type="password" id="confirm_password" name="confirm_password" value="">
        </div>
        <div class="con birth">
          <label for="birthday">생년월일</label>
          <input type="number" name="user_birth_year" id="birthyear" min="1900" maxlength="4" oninput="maxLengthCheck(this)" value="<?=$row['user_birth_year']?>" readonly>
          <input type="number" name="user_birth_month" id="birthmonth" min="1" maxlength="2" oninput="maxLengthCheck(this)" value="<?=$row['user_birth_month']?>" readonly>
          <input type="number" name="user_birth_day" id="birthdate" min="1" maxlength="2" oninput="maxLengthCheck(this)" value="<?=$row['user_birth_day']?>" readonly>
        </div>
        <div class="con phone">
          <label for="phone">연락처</label>
          <input type="text" name="phone_first" id="phone_first" maxlength="3" oninput="maxLengthCheck(this)" value="<?=substr($row['user_phone'], 0, -8)?>">
          -
          <input type="number" name="phone_mid" id="phone_mid" value="<?=substr($row['user_phone'], -8, 4)?>" maxlength="4" oninput="maxLengthCheck(this)">
          -
          <input type="number" name="phone_last" id="phone_last" value="<?=substr($row['user_phone'], -4, 4)?>" maxlength="4" oninput="maxLengthCheck(this)">
        </div>
        <div class="con tell">
          <label for="telephone">전화번호</label>
          <input name="telephone_first" id="telephone_first" value="<?=substr($row['user_telephone'], 0, -8)?>" >
          -
          <input type="number" name="telephone_mid" id="telephone_mid" value="<?=substr($row['user_telephone'], -8, 4)?>" min="0" maxlength="4" oninput="maxLengthCheck(this)">
          -
          <input type="number" name="telephone_last" id="telephone_last" value="<?=substr($row['user_telephone'], -4, 4)?>" min="0" maxlength="4" oninput="maxLengthCheck(this)">

        </div>
        <div class="con email">
          <label for="email">이메일</label>
          <input type="text" name="email_id" id="email_id" value="<?=$email_id?>">
          <span>@</span>
          <select name="email_domain" id="email_domain">
            <option value="<?=$email_domain?>" name="email_domain" id="email_domain"><?=$email_domain?></option>
            <?php
              if ($email_domain === "gmail.com") {
                echo '<option value="naver.com">naver.com</option>';
                echo '<option value="nate.com">nate.com</option>';
                echo '<option value="hanmail.net">hanmail.net</option>';
              } else if ($email_domain === "naver.com") {
                echo '<option value="naver.com">gmail.com</option>';
                echo '<option value="nate.com">nate.com</option>';
                echo '<option value="hanmail.net">hanmail.net</option>';
              } else if ($email_domain === "nate.com") {
                echo '<option value="gmail.com">gmail.com</option>';
                echo '<option value="naver.com">naver.com</option>';
                echo '<option value="hanmail.net">hanmail.net</option>';
              } else{
                echo '<option value="gmail.com">gmail.com</option>';
                echo '<option value="naver.com">naver.com</option>';
                echo '<option value="nate.com">nate.com</option>';
              }
            ?>
          </select>
        </div>
        <div class="con addr">
          <label for="address">주소</label>
          <input type="text" id="addr1" name="user_addr1" value="<?=$row['user_addr1']?>">
          <input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기">
          <input type="text" id="addr2" name="user_addr2" value="<?=$row['user_addr2']?>">
          <input type="text" id="addr3" name="user_addr3" value="<?=$row['user_addr3']?>">
        </div>
        <div class="con job">
          <label for="job">직업</label>
          <input type="text" id="job" name="user_job" value="<?=$row['user_job']?>">
        </div>
        <div class="con interest">
          <label for="interest">관심분야</label>
          <select name="extra2" id="interest">
            <option value="<?=$row['extra2']?>" name="extra2" id="interest"><?=$row['extra2']?></option>
            <?php
              if ($row['extra2'] === "전문과정") {
                echo '<option value="일반/취미과정">일반/취미과정</option>';
              } else {
                echo '<option value="전문과정">전문과정</option>';
              }
            ?>
          </select>
        </div>
        <div class="submit">
          <button type="submit" id="edit_frm" onclick="check_input();">수정완료</button>
          <button type="reset" id="reset" onclick="out_input();">탈퇴하기</button>
        </div>
      </form>
    </div>
  </main>

  <script>
    $(function(){
      //id값을 post로 전송하여 서버와 통신을 통해 중복결과 json형태로 받아오기 위한 함수
      function checkIdAjax(){
        $.ajax({
          url:'./ajax/check_id.php',
          type:'post',
          dataType:'json',
          data:{
            'user_id':$('#id').val()
          },
          success:function(data){
            if(data.check){
              $('#id_check_msg').html('사용가능한 아이디 입니다.').css('color','#00f').attr('data-check','1');
            }else{
              $('#id_check_msg').html('중복된 아이디 입니다.').css('color','#f00').attr('data-check','0');
            }
          }
        })
      }
      
      $('#edit_frm').click(function(e){
        check_input(); //유효성 감사를 실시한다.
        e.preventDefault()
      });


      function check_input(){
        if (!$("#password").val()) {
            alert("정보수정을 위하여 \n비밀번호를 입력하여 주세요.");    
            $("#password").focus();
            return false;
          }
  
        if($('#password').val() !== $('#confirm_password').val()){
          alert('비밀번호가 일치하지 않습니다. \n다시 입력하여주세요.')
          $('#password').focus();
          return false
        }

        //위 입력양식 검사를 통하면 아래 폼 내용 전송
        $('#member_form').submit();
      }
    });
    
    function out_input(){
      if (confirm("정말로 탈퇴하시겠습니까?")) {
        location.href = "delet.php";
        }
      }

      // 생년월일 입력제한
      function maxLengthCheck(object){
        if (object.value.length > object.maxLength){
          object.value = object.value.slice(0, object.maxLength);
        }    
      }

  </script>

<?php
  include_once $_SERVER['DOCUMENT_ROOT']."/PETxLAB/user/footer.php";
?>
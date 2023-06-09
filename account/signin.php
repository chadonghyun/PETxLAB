
<?php
include_once '../db/db_con.php';
include_once '../config.php';
?>


<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>회원가입</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/favicon/favicon.ico" type="image/x-icon">
  <link rel="icon" href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/favicon/favicon.ico" type="image/x-icon">
  
  <link rel="stylesheet" href="../adm/css/base.css">
  <link rel="stylesheet" href="../adm/css/reset.css">
  <link rel="stylesheet" href="./css/signin.css">

  <!-- 다음 주소 api -->
  <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
  <script src="./script/addressapi.js"></script>
  <!-- 제이쿼리 CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    
</head>
<body>
  <header>
    <h1>
      <a href="<?php $_SERVER['DOCUMENT_ROOT']?>/PETxLAB/user/index.php" title="메인페이지 바로가기">
        <img src="./images/Logo.svg" alt="">
      </a>
    </h1>
  </header>

  <main>

    <div class="container">
      <form action="member_insert.php" method="post" id="member_form" name="회원가입">
        <div class="con">
          <label for="name">이름</label>
          <input type="text" id="name" name="user_name">
        </div>
        <div class="con">
          <label for="id">아이디</label>
          <input type="text" id="id" name="user_id">
          <span id="id_check_msg" data-check = "0"></span>
        </div>
        <div class="con">
          <label for="password">비밀번호</label>
          <input type="password" id="password" name="user_pass">
        </div>
        <div class="con">
          <label for="confirm_password">비밀번호 확인</label>
          <input type="password" id="confirm_password" name="confirm_password">
        </div>
        <div class="con birth">
          <label for="birthday">생년월일</label>
          <input type="number" name="user_birth_year" id="birthyear" placeholder="년(4자)" min="1900" maxlength="4" oninput="maxLengthCheck(this)">
          <input type="number" name="user_birth_month" id="birthmonth" placeholder="월" min="1" maxlength="2" oninput="maxLengthCheck(this)">
          <input type="number" name="user_birth_day" id="birthdate" placeholder="일" min="1" maxlength="2" oninput="maxLengthCheck(this)">
        </div>
        <div class="con phone">
          <label for="phone">연락처</label>
          <input type="text" name="phone_first" id="phone1" placeholder="010" maxlength="3" oninput="maxLengthCheck(this)">
          -
          <input type="number" name="phone_mid" id="phone2" placeholder="0000" maxlength="4" oninput="maxLengthCheck(this)">
          -
          <input type="number" name="phone_last" id="phone3" placeholder="0000" maxlength="4" oninput="maxLengthCheck(this)">
        </div>
        <div class="con tell">
          <label for="telephone">전화번호</label>
          <select name="telephone_first" id="telephone_first">
            <option value="지역번호">지역번호</option>
            <option value="02">02</option>
            <option value="031">031</option>
            <option value="032">032</option>
            <option value="033">033</option>
            <option value="041">041</option>
            <option value="042">042</option>
            <option value="043">043</option>
            <option value="044">044</option>
            <option value="051">051</option>
            <option value="052">052</option>
            <option value="053">053</option>
            <option value="054">054</option>
            <option value="055">055</option>
            <option value="061">061</option>
            <option value="062">062</option>
            <option value="063">063</option>
            <option value="064">064</option>
          </select>
          -
          <input type="number" name="telephone_mid" id="telephone_mid" placeholder="0000" min="0" maxlength="4" oninput="maxLengthCheck(this)">
          -
          <input type="number" name="telephone_last" id="telephone_last" placeholder="0000" min="0" maxlength="4" oninput="maxLengthCheck(this)">

        </div>
        <div class="con email">
          <label for="email">이메일</label>
          <input type="text" name="email_id" id="email_id" placeholder="아이디">
          <span>@</span>
          <select name="email_domain" id="email_domain">
            <option value="선택">선택</option>
            <option value="gmail.com">gmail.com</option>
            <option value="naver.com">naver.com</option>
            <option value="nate.com">nate.com</option>
            <option value="hanmail.net">hanmail.net</option>
          </select>
        </div>
        <div class="con addr">
          <label for="address">주소</label>
          <input type="text" id="addr1" name="user_addr1" placeholder="우편번호" readonly>
          <input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기">
          <input type="text" id="addr2" name="user_addr2" placeholder="주소" readonly>
          <input type="text" id="addr3" name="user_addr3" placeholder="상세주소">
        </div>
        <div class="con">
          <label for="job">직업</label>
          <input type="text" id="job" name="user_job" placeholder="직업을 입력해주세요">
        </div>
        <div class="con">
          <label for="interest">관심분야</label>
          <select name="extra2" id="interest">
            <option value="전문과정" name="extra2" id="interest">전문과정</option>
            <option value="일반/취미과정" name="extra2" id="interest">일반/취미과정</option>
          </select>
        </div>
        <div class="submit">
          <button type="submit" id="save_frm">회원가입</button>
          <button type="reset" id="reset">다시쓰기</button>
        </div>
      </form>
    </div>

  </main>  

  <footer>
    Copyright(c) 2023.PETxLAB.All right reserved.
  </footer>

  <script>
    $(function(){

      $('#id').blur(function(){ //아이디 박스를 벗어나면 
        if($(this).val()==''){
          $('#id_check_msg').html('아이디를 입력해주세요.').css('color','#f00').attr('data-check','0');
        }else{
          checkIdAjax();
        }
      });

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

      $('#save_frm').click(function(e){
        check_input(); //유효성 감사를 실시한다.
        e.preventDefault()
      });


      function check_input(){
        if(!$('#name').val()){
          alert('이름을 입력하지 않았습니다.')
          $('#name').focus();
          return false
        }
        if(!$('#id').val()){
          alert('아이디를 입력하지 않았습니다.');
          $('#id').focus();
          return false
        }
        if($('#id_check_msg').attr('data-check')=='0'){
          alert('아이디가 존재합니다. 다시 입력하세요.')
          $('#id').focus();
          return false
        }
        if(!$('#password').val()){
          alert('비밀번호를 입력하지 않았습니다.');
          $('#password').focus();
          return false
        }
        if(!$('#confirm_password').val()){
          alert('비밀번호를 입력하지 않았습니다.');
          $('#confirm_password').focus();
          return false
        }
        if(!$('#birthyear, #birthmonth, #birthdate').val()){
          alert('생년월일을 입력하지 않았습니다.');
          $('#birthyear').focus();
          return false
        }
        if(!$('#phone1, #phone2, #phone3').val()){
          alert('연락처를 입력하지 않았습니다.');
          $('#phone1').focus();
          return false
        }
        if(!$('#telephone, #telephone_mid, #telephone_last').val()){
          alert('전화번호를 입력하지 않았습니다.');
          $('#telephone').focus();
          return false
        }
        if(!$('#email_id, #email_domain').val()){
          alert('이메일를 입력하지 않았습니다.');
          $('#email_id').focus();
          return false
        }
        if(!$('#addr1, #addr2, addr3').val()){
          alert('주소를 입력하지 않았습니다.');
          $('#addr3').focus();
          return false
        }
        if($('#password').val()!=$('#confirm_password').val()){
          alert('비밀번호가 일치하지 않습니다. \n다시 입력하여주세요.')
          $('#password').focus();
          return false
        }

        //위 입력양식 검사를 통하면 아래 폼 내용 전송
        $('#member_form').submit();

      }

      })

      const passwordInput = document.getElementById('password');
      const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])(?=.*[^\da-zA-Z]).{8,}$/;

      passwordInput.addEventListener('input', () => {
        if (!passwordPattern.test(passwordInput.value)) {
          passwordInput.setCustomValidity('비밀번호는 영문 대소문자, 숫자, 특수문자가 하나 이상씩 포함되어야 하며, 최소 8자 이상이어야 합니다.');
        } else {
          passwordInput.setCustomValidity('');
        }
      });

      // 생년월일 입력제한
      function maxLengthCheck(object){
        if (object.value.length > object.maxLength){
          object.value = object.value.slice(0, object.maxLength);
        }    
      }

  </script>

  
</body>
</html>
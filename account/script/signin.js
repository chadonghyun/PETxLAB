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
        'id':$('#id').val()
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
    if(!$('#confim_password').val()){
      alert('비밀번호를 입력하지 않았습니다.');
      $('#confim_password').focus();
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
    if($('#pw').val()!=$('#pw2').val()){
      alert('비밀번호가 일치하지 않습니다. \n다시 입력하여주세요.')
      $('#pass').focus();
      return false
    }

    //위 입력양식 검사를 통하면 아래 폼 내용 전송
    $('#member_form').submit();

  }

})
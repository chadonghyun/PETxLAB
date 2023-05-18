$(function(){
const v = document.getElementById('class_video');

  $('#btn01').click(function(){
    $('#btn03, #btn04, #btn05, #btn06, #play_wrap').css('display','block')
    $('#btn01').hide();
    $('#btn02').show();
    v.play();
    $('#btn02, #btn03, #btn04, #btn05, #btn06, #play_wrap').fadeOut(1500);
    $('#class_video').click(function(){
      $('#btn02, #btn03, #btn04, #btn05, #btn06, #play_wrap').show(0);
      // $('#btn02, #btn03, #btn04, #btn05, #btn06, #play_wrap').fadeOut(10000);
      return false;
    });
    setInterval(function() {
      const currentTime = v.currentTime;
      const duration = v.duration;
      const width = (currentTime / duration) * 100;
      $('#play_now').css('width', width + '%');
    }, 100);
  });

  $('#btn02').click(function(){
    v.pause();
    $('#btn02').hide();
    $('#btn01').show();
  });

  $('#btn03').click(function(){
    v.currentTime-=5;
  });

  $('#btn04').click(function(){
    v.currentTime+=5;
  });

  $('#btn05').click(function() {
    $('.speed_box').toggleClass('on');
  });

  $('#btn06').click(function(){
    v.requestFullscreen()
  });

  $('#btn07').click(function(){
    v.playbackRate=1;
  });

  $('#btn08').click(function(){
    v.playbackRate=1.5;
  });

  $('#btn09').click(function(){
    v.playbackRate=2;
  });

});

function goBack() {
  history.back();
}


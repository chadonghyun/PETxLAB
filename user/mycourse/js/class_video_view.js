$(function(){
  const v = $('#class_video').get(0);

  $('#btn01').click(function(){
    $('#btn03, #btn04, #btn05, #btn06, #play_wrap').css('display','block')
    $('#btn01').hide();
    $('#btn02').show();
    v.play();
    $('#btn02, #btn03, #btn04, #btn05, #btn06, #play_wrap').fadeOut(1000);
    $('#class_video').click(function(){
      $('#btn02, #btn03, #btn04, #btn05, #btn06, #play_wrap').show(0);
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

  $('#btn06').click(function(){
    v.requestFullscreen()
  });
});
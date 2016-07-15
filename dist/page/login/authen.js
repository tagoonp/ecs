$(document).ready(function(){
  $i = 0; $loadStage = 0;
  var jqxhr = $.post( "core/acc-log.php", { pages : 'index.html' },function() {});

  $('.js-validation-login').submit(function(){
    if(($('#txt-username').val()!='') && ($('#txt-password').val()!='')){
      $('.login').hide();
      $('.loading').show();
      loadBar($i);

      var jqxhr = $.post( "core/authen.php", { username : $('#txt-username').val(), password : $('#txt-password').val() },function() {});

      jqxhr.done(function() {
              $('#progress-bar').css('width', '60%').attr('aria-valuenow', '60');
              $('#loadLabel').text('60%');
              $loadStage = 1;
              $i = 60;
      });

      jqxhr.always(function(result) {
              $('#progress-bar').css('width', '100%').attr('aria-valuenow', '100');
              $('#loadLabel').text('100%');
              $loadStage = 2;
              $i = 100;
              setTimeout(function(){
                if(result=='Y'){

                  setTimeout(function(){
                    window.location = 'core/redirectuser.php';
                  }, 1000);

                }else{
                  console.log(result);
                  alert('ไม่พบบัญชีผู้ใช้นี้');
                  $('#progress-bar').css('width', '0%').attr('aria-valuenow', '0');
                  $('#loadLabel').text('');
                  $('.login').show();
                  $('.loading').hide();
                }
              },300);
      });
    }
  });
});

function loadBar(i){
  $('#progress-bar1').css('width', i+'%').attr('aria-valuenow', i);
  $('#loadLabel1').text(((i)-1 )+ '%');
  $i++;
  iniInterval();
}

function iniInterval(){
  setTimeout(function(){
    if($loadStage != 2){
      loadBar($i);
    }
  },1000);
}

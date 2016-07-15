$(document).ready(function(){
  var jqxhr = $.post( "../core/acc-log.php", { pages : 'coder/register.php' },function() {});

  var jqxhr2 = $.post( "../core/get-department.php", function(result) {
    for (var i = 0; i < result.length; i++) {
        $('#txt-department').append('<option value=' + result[i].dept_id + '>' + result[i].dept_name + '</option>');
      }
  },"json");
});

jQuery( function() {
  $i = 0; $loadStage = 0;

  $('.js-validation-material').submit(function(){
    if(($('#txt-fname').val()!='') && ($('#txt-lname').val()!='') && ($('#txt-phone').val()!='') && ($('#txt-email').val()!='') && ($('#txt-department').val()!='')){
      $('.register').hide();
      $('.loading').show();
      loadBar($i);

      var jqxhr = $.post( "../core/register.php", {
                  prefix : $('#txt-prefix').val(),
                  fname : $('#txt-fname').val(),
                  lname : $('#txt-lname').val(),
                  phone : $('#txt-phone').val(),
                  email : $('#txt-email').val(),
                  dept : $('#txt-department').val()
                },function() {

                });

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
                    alert('ลงทะเบียนผู้วิจัยเรียบร้อย');
                    location.reload();
                  }, 1000);

                }else if(result=='N'){
                  alert('ไม่สามารถลงทะเบียนผู้วิจัยได้');
                  $('#progress-bar').css('width', '0%').attr('aria-valuenow', '0');
                  $('#loadLabel').text('');
                  $('.register').show();
                  $('.loading').hide();
                }else{
                  alert(result);
                  $('#progress-bar').css('width', '0%').attr('aria-valuenow', '0');
                  $('#loadLabel').text('');
                  $('.register').show();
                  $('.loading').hide();
                }
              },300);
      });

    }
  });
	$('.js-validation-material-adddept').submit(function(){
    if($('#txt-deptadd').val()!=''){
      var jqxhr3 = $.post( "../core/insert-department.php",{ dept_name: $('#txt-deptadd').val() }, function(){});

      jqxhr3.always(function(result) {

        if(result=='Y'){
          var $select = $('#txt-department');
          $select.find('option').remove();

          $('#txt-department').append('<option value=""></option>');

          var jqxhr2 = $.post( "../core/get-department.php", function(result) {
            for (var i = 0; i < result.length; i++) {
                $('#txt-department').append('<option value=' + result[i].dept_id + '>' + result[i].dept_name + '</option>');
              }
          },"json");

          $('#modal-addept-close').trigger('click');
          ('#txt-department').val();
        }else{
          alert('ไม่สามารถเพิ่มภาควิชา / สาขาวิชาได้');
        }
      });
    }
  });
});

function loadBar(i){
  $('#progress-bar').css('width', i+'%').attr('aria-valuenow', i);
  $('#loadLabel').text(((i)-1 )+ '%');
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

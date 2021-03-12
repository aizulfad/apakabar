
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$title ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <script src="https://www.google.com/recaptcha/api.js?hl=<?=$lang ?>&onload=onloadCallback" async defer></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=base_url() ?>assets/css/tabs.css">
  <link rel="stylesheet" href="<?=base_url() ?>assets/css/select.css">
  <link rel="shortcut icon" href="<?=base_url('assets/img/icon.ico') ?>">

  <script>
    
    var onSubmit = function(token) {
        document.getElementById('send_reset').disabled = false;
    };

    var verifyCallback = function(response) {
        document.getElementById('send_reset').disabled = false;
    };

    var fnCallback = function() {
      // grecaptcha.reset();
      document.getElementById('send_reset').disabled = true;
    };

    var onloadCallback = function() {
        grecaptcha.render('html_element', {
          'sitekey' : '6LfgFDcaAAAAAEsY8hiNfuhtC0-Y4DQY4RCvtmbo',
          'callback' : verifyCallback,
          'expired-callback': fnCallback
        });

        document.getElementById('send_reset').disabled = true;
    };

  </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="row">
    <div class="col-md-12 text-center mb-2">
      <img width ="350" height="230" src="<?=base_url('assets/img/logo.png') ?>" alt="">
    </div>
  </div>
  <div class="card">
    <div class="card-body p-0">
      <div class="text-center"><?=$this->session->flashdata('exp') ?></div>
      <div class="text-center"><?=$this->session->flashdata('message') ?></div>


      <div class="tab-content">
        <div class="tab-pane fade show active" id="tabA">
          <div class="float-left">
            <h3 class="text-small">Login</h3>
          </div>
          <div class="input-group">
            <div class="input-group-append">
              <div class="input-group-text first">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <input type="email" class="form-control border-left-0" placeholder="Masukkan email" name="email" value="<?=get_cookie('cookielogin[email]') ?>" id="inputEmail">
          </div>
          <div class="row mt-2">
            <div class="col-md-1">
              <span id="iconEror"></span>
            </div>
            <div class="col-md-11">
              <p class="text-danger" id="emailNotif"></p>
            </div>
          </div>
          <div class="input-group">
            <div class="input-group-append">
              <div class="input-group-text first">
                <i class="fas fa-lock"></i>
              </div>
            </div>
            <input type="password" class="form-control border-right-0 border-left-0" placeholder="Masukkan password" name="password" id="pd">
            <div class="input-group-append">
              <div class="input-group-text last" onmousedown="showText(pd)" onmouseup="showPassword(pd)"  onmouseout="showPassword(pd)">
                <span class="fas fa-eye" id="icon"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1">
              <span id="iconErorPass"></span>
            </div>
            <div class="col-md-11">
              <p class="text-danger" id="errorPassLogin"></p>
            </div>
          </div>
          <!-- <p id="errorLogin" class="text-danger"></p> -->
          <div class="row">
            <div class="col-12 mt-3">
              <button type="submit" class="btn btn-danger btn-block" name="signin" id="btnLogin">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?=base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="<?=base_url() ?>assets/js/adminlte.min.js"></script>
<script src="<?=base_url() ?>assets/js/tabs.js"></script>
<script src="<?=base_url() ?>assets/js/select.js"></script>

<script>

var inputEmail;
var inputPwd;
var count;
var countSms;
var phoneNumber;


// hidden modal reset
$('#exampleModal').on('hidden.bs.modal', function () {
  $('#exampleModal input').val("");
   $("#errorResetPass, #iconResetPass").empty();
    $("#email_reset").removeClass("is-invalid");
    $("#email_reset").prev().find(".input-group-text").removeClass("errorClass");
    $("#email_reset").next().find(".input-group-text").removeClass("errorClass");
    grecaptcha.reset();
});

// klik login
$("#btnLogin").click(function(){
  inputEmail = $("#inputEmail").val();
  inputPwd = $("#pd").val();
  var remember = $("#remember:checked").val();

  $("#inputEmail, #pd").removeClass("is-invalid");
  $('#emailNotif, #errorPassLogin').text("");
  $("#inputEmail, #pd").prev().find(".input-group-text").removeClass("errorClass");
  $("#iconEror, #iconErorPass, #errorLogin").empty();

  $.ajax({
    url:"<?php echo base_url(); ?>login/user-login",
    method:"POST",
    data: {email: inputEmail, password : inputPwd, remember: remember},
    dataType:"json",
    beforeSend: function()
      {
        document.getElementById('btnLogin').innerHTML = "<img id=\"loading\" src=\"<?= base_url('assets/img/loader.gif')?>\">"
        $("#btnLogin").attr("disabled", "disabled");
      },
    success:function(data)
    {
      document.getElementById('btnLogin').innerHTML = "Login";
      $("#btnLogin").removeAttr("disabled");

      if(data.status == 10000){
        window.location.href = "<?=base_url() ?>";
      }

      if(data.status == 10009){
        $("#iconEror").html("<img src='<?=base_url() ?>assets/img/ic_error.svg' >");
        $("#inputEmail").addClass("is-invalid");
        $("#inputEmail").prev().find(".input-group-text").addClass("errorClass");
        $('#emailNotif').text(data.message);
      }

      if(data.status == 10004){
        $('#modalOtp').modal({backdrop: 'static', keyboard: false, show: true})
        var seconds = data.count;
        var countdown = setInterval(function() {
            seconds--
            document.getElementById("count").innerHTML = "( "+seconds+" )";
            console.log(seconds);
            $("#btnCounter").addClass("disabled")            
            if (seconds <= 0) {
              $("#count").empty();
              $("#btnCounter").removeClass("disabled")
              clearInterval(countdown);
            }
            $(".close-otp").on("click", function() {
              $("#count").empty();
              clearInterval(countdown);
            });
        }, 1000);
      }

      if(data.status == 20000){
        $("#iconErorPass").html("<img src='<?=base_url() ?>assets/img/ic_error.svg' >");
        $('#errorPassLogin').text(data.message);
      }

      if(data.status == 10005){

        if(data.dataCountdown.attemp >= 5){
          $("#inputEmail").val('');
          $("#pd").val('');
          $('#errorPassLogin').val('');
          $('#modalCountdown').modal({backdrop: 'static', keyboard: false, show: true})
          
          var countDownDate = new Date(data.dataCountdown.time).getTime();

          var x = setInterval(function() {
            var now = new Date().getTime();

            var distance = countDownDate - now;
              
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            var satuan = (minutes == 0) ? "<?=$this->lang->line('second') ?>" : "<?=$this->lang->line('minute') ?>";
            
            document.getElementById("blockCountdown").innerHTML = `${minutes}:${seconds} ${satuan}`;

            if (minutes == 0 && seconds == 0) {
              clearInterval(x);
              $.post("<?=base_url()?>login/deleteBlockCountdown",{id: data.dataCountdown.id_countdown},function(data){
                document.getElementById("blockCountdown").innerHTML = "";
                location.reload();
              });
            }
          }, 1000);
        } else {
          $("#iconErorPass").html("<img src='<?=base_url() ?>assets/img/ic_error.svg' >");
          $("#pd").addClass("is-invalid");
          $("#pd").prev().find(".input-group-text").addClass("errorClass");
          $("#pd").next().find(".input-group-text").addClass("errorClass");
          $('#errorPassLogin').html(data.message);
        }
      }

      if(data.status == 20004){
        $("#iconEror").html("<img src='<?=base_url() ?>assets/img/ic_error.svg' >");
        $("#inputEmail").addClass("is-invalid");
        $("#inputEmail").prev().find(".input-group-text").addClass("errorClass");
        $('#emailNotif').text(data.message);
      }

      if(data.status == 20005){
        $("#iconErorPass").html("<img src='<?=base_url() ?>assets/img/ic_error.svg' >");
        $('#errorPassLogin').text(data.message);
      }
    }
  });
})



function showText(x){
  x.type = "text";
  document.getElementById("icon").className = "fas fa-eye-slash";
}
function showPassword(x){
  x.type = "password";
  document.getElementById("icon").className = "fas fa-eye";
}

//On click show password
function myFunction() {
  var x = document.getElementById("pwd");
  icon = document.getElementById("icon");
    if (x.type === "password") {
        x.type = "text";
        icon.className= "fas fa-eye-slash";
    } else {
        x.type = "password";
        icon.className= "fas fa-eye";
    }
}
</script>

</body>
</html>

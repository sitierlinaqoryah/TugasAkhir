<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admina Bootstrap Admin. This is the demo of Admina. You need to purchase a license for legal use!">
    <meta name="author" content="DownTown Themes">
    <link rel="shortcut icon" href="{BASE_URL}img/favicon.png">
    <title>SPK-SMART</title>
    
    <!--Icon fonts css-->
    <link href="{BASE_URL}themes/admina/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{BASE_URL}themes/admina/plugins/ionicon/css/ionicons.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="{BASE_URL}themes/admina/css/bootstrap.min.css" rel="stylesheet">
    <link href="{BASE_URL}themes/admina/css/bootstrap-reset.css" rel="stylesheet">

    <!--Animation css-->
    <link href="{BASE_URL}themes/admina/css/animate.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{BASE_URL}themes/admina/css/style.css" rel="stylesheet">
    <link href="{BASE_URL}themes/admina/css/helper.css" rel="stylesheet">
    <link href="{BASE_URL}themes/admina/css/style-responsive.css" rel="stylesheet" />

    <style>
      label {
        font-weight: normal;
        width: 100%
      }
      label.error {
        color: #A00;
      }
      input, textarea {
        width: 300px;
      }
      .jumbotron {
        font-size: 14px;
      }
      button {
        margin-top: 15px;
      }
      #captcha-wrapper {
        margin-bottom: 10px;
      }
      #refresh-captcha {
        cursor: pointer;
      }
    </style>

  </head>
    <body>
      {MESSAGE}
      <div class="wrapper-page animated fadeInDown">
        <div class="panel panel-color panel-info">
          <div class="panel-heading"> 
            <center><img src="{BASE_URL}img/logo.png" alt="Logo" width="120px" height="120px"></center>
             <h3 class="text-center m-t-10">SPK Pemilihan Karyawan Teladan menggunakan metode SMART</h3>
          </div> 
          <form class="form-horizontal m-t-40 cmxform tasi-form" method="post" action="" id="contact-form" novalidate="novalidate" action="{BASE_URL}pages/login">               
              <div class="form-group">
                  <div class="col-xs-12">
                    <!-- username dan password untuk menu login pada view(tampilan login) -->
                      <label>Username</label>
                      <input class="form-control" type="text" name="user" id="user" required="">
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-xs-12">
                      <label>Password</label>
                      <input class="form-control" type="password" name="pass" id="pass" required="">
                  </div>
              </div>
             
              
              <div class="form-group" align="center">
                  <div class="col-xs-12">
                    <button class="btn btn-info w-md" type="submit" name="btnLogin" value="login">Login</button>
                  </div>
              </div>
          </form>
        </div>
      </div>

      <!-- Basic Plugins -->
      <script src="{BASE_URL}themes/admina/js/jquery.js"></script>
      <script src="{BASE_URL}themes/admina/js/bootstrap.min.js"></script>
      <script src="{BASE_URL}themes/admina/js/pace.min.js"></script>
      <script src="{BASE_URL}themes/admina/js/wow.min.js"></script>
      <script src="{BASE_URL}themes/admina/js/jquery.nicescroll.js" type="text/javascript"></script>
      <!-- Form validation -->
      <script type="text/javascript" src="{BASE_URL}themes/assets/jquery-validate/jquery.validate.min.js"></script>
      <script type="text/javascript" src="{BASE_URL}themes/assets/jquery-validate/form-validation-init.js"></script>
      <script src="{BASE_URL}themes/admina/js/app.js"></script>

      <script type="text/javascript">
      $(document).ready(function (){
        $("#contact-form").validate({
          rules: {
            captcha: {
              required: true,
              remote: {
                url: '{BASE_URL}themes/assets/captcha/verify-captcha.php',
                type: 'post',
                data: {
                  username: function() {
                    return $( '#captcha' ).val();
                  }
                }
              }
            }
          },
          messages: {
            captcha: {
              remote: "Enter the correct text"
            }
          }
        });

        $('#refresh-captcha').click(function(){
          $('#captcha-image').attr('src', '{BASE_URL}themes/assets/captcha/generate-captcha.php?r=' + Math.random());
          return false;
        });
      });
    </script>
    </body>
</html>
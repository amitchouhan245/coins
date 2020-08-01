<?php 
   date_default_timezone_set('America/Los_Angeles');   
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="DJM0dAipemjjyEHSulW3AotJpwd5FFCEwTSnQtFs">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/ content-Type="image/jpeg">
  </head>
  <body style="margin:0px; background-color: #eee">
    <style type="text/css">
      @font-face {
        font-family: CenturyGothic;
        src: url(public/uploads/email/GOTHIC.TTF);
      }
      #logo-bg {
          background-image:url('images/login/login_background.jpg');
          font-size: 20px;
      }
    </style>
    <div style="width: 800px; margin: 0 auto; background-color: #fff; font-family: CenturyGothic;">
      <div style="background-color: #0a4382; padding:10px; text-align: center;">
        <img src="http://34.73.27.222/r-taxi/public/AdminTheme/app-assets/images/logo/logo.png">
      </div>
      <div>
        <img src="http://34.73.27.222/r-taxi/public/uploads/email/banner.png" width="100%">
      </div>
      <div style="padding:0px 50px;">
        <div style="background-color: #eff3f7; padding:40px 50px; text-align: center;">
          <div>
            <img src="http://34.73.27.222/r-taxi/public/uploads/email/message.png" style="margin-bottom: 30px;">
          </div>
          <h2 style=" color: #ee2c30; margin-top:30px; margin-bottom: 30px;">

             {{ trans('messages.FORGOT_PASSWORD')}}

          </h2>
       
        <p style="font-size:14px; line-height: 20px;">

         <h2 style="font-weight:normal;">{{ trans('messages.HELLO') }}, <br> 
         {{ trans('messages.PLEASE_USE_THIS_OTP')}}  <?php echo $code; ?> 
         {{ trans('messages.TO_RESET_YOUR_PASSWORD')}}</h2>

        </p>
        </div>
      </div>
      <div style="background-color: #0a4382; padding:10px; text-align: center;">
        <a href="#"><img src="http://34.73.27.222/r-taxi/public/uploads/email/facebook.png" height="35"></a>&nbsp;&nbsp;&nbsp;
        <a href="#"><img src="http://34.73.27.222/r-taxi/public/uploads/email/instagram.png" height="35"></a>&nbsp;&nbsp;&nbsp;
        <a href="#"><img src="http://34.73.27.222/r-taxi/public/uploads/email/pintrest.png" height="35"></a>&nbsp;&nbsp;&nbsp;
        <a href="#"><img src="http://34.73.27.222/r-taxi/public/uploads/email/twitter.png" height="35"></a>
      </div>
    </div>
  </body>
</html>
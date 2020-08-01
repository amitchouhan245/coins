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
      <div style="background-color: #b59a3b; padding:10px; text-align: center;">
         {!! Html::image('public/uploads/email/logo@3x.png', 'branding logo', ['alt' => 'User profile picture',"style" => 'width:200px;height:100px;']) !!}

        <b style="font-size: 50px;">Affluent Spark</b>
      </div>
      <div>

          {!! Html::image('public/uploads/email/banner.png', 'branding logo', ['alt' => 'User profile picture',"style" => 'width:100%;']) !!}
      </div>
      <div style="padding:0px 50px;">
        <div style="background-color: #eff3f7; padding:40px 50px; text-align: center;">
          <div>
          {!! Html::image('public/uploads/email/message.png', 'branding logo', ['alt' => 'User profile picture',"style" => 'margin-bottom:30px;']) !!}
            
          </div>
          <h2 style=" color: #ee2c30; margin-top:30px; margin-bottom: 30px;">

              <b>You're now a part of our Affluent Spark Community.</b>

          </h2>
        <p style="font-size:14px; line-height: 20px;">

        <br>

        <b>Thank you</b>
        
        </p>
        <p style="font-size:14px; line-height: 20px;">

        <b>BEGIN YOUR Experience with Affluent Spark.</b>

          <br>
     
          <p>Download our App</p>

        </p>
        </div>
      </div>
      <div style="background-color: #b59a3b; padding:10px; text-align: center;">

             {!! Html::image('public/uploads/email/facebook.png', 'branding logo', ['alt' => 'User profile picture',"style" => 'height:35px;']) !!}&nbsp;&nbsp;&nbsp;
             {!! Html::image('public/uploads/email/instagram.png', 'branding logo', ['alt' => 'User profile picture',"style" => 'height:35px;']) !!}&nbsp;&nbsp;&nbsp;
             {!! Html::image('public/uploads/email/pintrest.png', 'branding logo', ['alt' => 'User profile picture',"style" => 'height:35px;']) !!}&nbsp;&nbsp;&nbsp;
             {!! Html::image('public/uploads/email/twitter.png', 'branding logo', ['alt' => 'User profile picture',"style" => 'height:35px;']) !!}&nbsp;&nbsp;&nbsp;
      </div>
    </div>
  </body>
</html>
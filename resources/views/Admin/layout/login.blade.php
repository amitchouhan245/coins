<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>{{Config::get('constants.PROJECT_TITLE')}}
  </title>
  <link rel="apple-touch-icon" href="../../app-assets/images/ico/apple-icon-120.png">
 
  <link rel="shortcut icon" type="image/x-icon" href="../../app-assets/images/ico/favicon.ico">
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  >
  <link rel="stylesheet" href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  >
  
  {!! Html::style('public/AdminTheme/app-assets/css/vendors.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/vendors/css/forms/icheck/icheck.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/vendors/css/forms/icheck/custom.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/css/pages/login-register.css') !!}
  {!! Html::style('public/AdminTheme/assets/css/style.css') !!}
  {!! Html::style('public/AdminTheme/app-assets/css/pages/error.css') !!}

  {!! Html::script('public/AdminTheme/app-assets/js/core/libraries/jquery.min.js') !!} 
  {!! Html::style('public/AdminTheme/app-assets/css/app.css')!!}


</head>

@php

  $userInfo = json_decode(Cookie::get('admin'));
    
  if(isset($userInfo->remember_me) && $userInfo->remember_me == "on") {
    
    $remember_me  = $userInfo->remember_me;    
    $email        = $userInfo->email;    
    $password     = $userInfo->password;    
    $mobileNumber = $userInfo->mobile_number;    

  }
    
 @endphp

<body class="vertical-layout vertical-menu 1-column bg-full-screen-image  menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu" data-col="1-column">
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                  <div class="card-title text-center">
                    <div class="p-1">

                   <!--    {!! Html::image('public/AdminTheme/app-assets/images/logo/enquiry.png', 'branding logo', ["style" => 'width:200px;']) !!} -->
                   <h2><b>{{Config::get('constants.PROJECT_TITLE')}}</b></h2>
                    </div>
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Login</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <div class="alert alert-success" id="verification_message" style="display: none;">                 
                      <strong>Success!</strong>Great! Your password has been reset successfully.
                    </div>

                    {!! Form::open(array('class' => ' ', 'id' => 'loginForm','name' => 'loginForm' ,'method' => 'GET')) !!}
                      <fieldset class="form-group position-relative has-icon-left ">
                        <input type="text" class="form-control " id="email" name="email" value="{{ @$email }}" placeholder="Enter Email"
                        >
                        <div class="form-control-position">
                          <i class="ft-user"></i>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="{{ @$password }}">
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>
                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-md-left">
                          <fieldset>
                            <input type="checkbox" id="remember_me" name = "remember_me" class="chk-remember">
                            <?php
                            
                              $type = Request::segment('1');

                              if( $type == "societyadmin"){

                                $user_type = '2';

                              }else{

                                $user_type = '1';
                              }

                            ?>
                            <label for="remember-me"> Remember Me</label>
                          </fieldset>
                        </div>
                        <div class="col-md-6 col-12 text-center text-md-right"><a href="{{ @$app_url.'forgot-password'}}">Forgot Password</a></div>
                      </div>
                      <button type="submit" id="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i> Login</button>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>



  {!! Html::script('public/AdminTheme/app-assets/vendors/js/vendors.min.js')!!}
  {!! Html::script('public/AdminTheme/app-assets/vendors/js/forms/icheck/icheck.min.js')!!}
  {!! Html::script('public/AdminTheme/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')!!}
  {!! Html::script('public/AdminTheme/app-assets/js/scripts/forms/form-login-register.js') !!}

  {!! Html::script('public/AdminTheme/app-assets/js/core/libraries/jquery.validate.min.js')!!}

  {!! Html::script('public/AdminTheme/assets/js/scripts.js')!!}

  {!! Html::script('public/AdminTheme/app-assets/vendors/js/extensions/sweetalert.min.js') !!}
 
  {!! Html::script('public/AdminTheme/app-assets/js/scripts/extensions/sweet-alerts.js') !!}

  <script type="text/javascript">

    var APP_URL =  "{{ url('/') . '/'.Request::segment('1') }}/";
    
    var item_message = localStorage.getItem("remmeber_email");

    if ( item_message == "undefined") {
    //  $('#verification_message').hide();
    }
    else if(item_message == null){
     //  $('#verification_message').hide();
    }
    else{
     
      $('#verification_message').show(); 
    }
    
    $(document).ready(function(){
        
      $("#loginForm").validate({
    
        rules: {

          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
            minlength: 5
          }
        },
    
        messages: {
          email: {
            required: "Please enter email",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please enter password",
            minlength: "Your password must be at least 5 characters long"
          },
        },
    
      submitHandler: function(form) {
        
        //med('add', 'submit', 'Please wait..');
        
        var formData = new FormData();
        
        var formData = {

            'email': $("#email").val(),
            'password': $("#password").val(),
            'user_type': "{{ $user_type }}"

          };
         
        $.ajax({
                   
          url: "{{ url('api/login') }}", 
          type: 'GET', 
          data: formData,
          headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function(res) {            
                              
            //med('add', 'submit', 'Redirecting');
 
            set_session(res.result,$("#password").val()); 

            localStorage.removeItem("remmeber_email");         
            
          },
          error: function(error){
        
            ajax_error(error,'submit','login');
    
          }  

        });
      }

    });

      function set_session(info,password){

        console.log(info);

        var RememberMe = "";
                
        if ($('#remember_me').is(':checked')) {

          RememberMe = "on";
        }

        if(info.user_type != 2){

          data = {

            'id': info.id,
            'first_name': info.first_name,
            'last_name': info.last_name,
            'full_name': info.first_name+' '+info.last_name,
            'email': info.email,
            'password': password,
            'mobile_number': info.mobile_number,
            'user_type': info.user_type,
            'user_type_name': "{{ Request::segment('1') }}",
            'profile_image': info.profile_image,
            'jwt_token': info.token,
            'remember_me': RememberMe,
            'token' : $('meta[name="csrf-token"]').attr('content')
          };

        }else{

          data = {

            'id': info.id,
            'first_name': info.first_name,
            'last_name': info.last_name,
            'full_name': info.first_name+' '+info.last_name,
            'email': info.email,
            'password': password,
            'mobile_number': info.mobile_number,
            'user_type': info.user_type,
            'user_type_name': "{{ Request::segment('1') }}",
            'profile_image': info.profile_image,
            'society_id':info.society_data.society.id,
            'society_title':info.society_data.society.title,
            'jwt_token': info.token,
            'remember_me': RememberMe,
            'token' : $('meta[name="csrf-token"]').attr('content')
          
          };

        }


        $.ajax({

          url: APP_URL + 'set-session', 
          type: 'GET', 
          data: data,
          headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function(res) {
            
            med('add', 'submit', 'Redirecting..');

            window.location.href = APP_URL + 'dashboard';

          },

          error:function(data){

            console.log(data);     

          }

        });

      }

  });

    var remember_me = "{{ @$remember_me}}";

    if (remember_me === "on") {

      $("#remember_me").attr('checked', true);
      
    }else{

      $("#remember_me").attr('checked', false);
    }

  </script>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="PIXINVENT">
  <title>{{Config::get('constants.APP_NAME')}} | {{$title}}</title>

  {!! Html::style('public/AdminTheme/app-assets/images/ico/apple-icon-120.png')!!}
  {!! Html::style('public/AdminTheme/app-assets/images/ico/favicon.ico')!!}

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  
  {!! Html::style('public/AdminTheme/app-assets/css/vendors.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/css/app.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/css/core/menu/menu-types/vertical-menu.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/css/core/colors/palette-gradient.css')!!}
  {!! Html::style('public/AdminTheme/assets/css/style.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/css/pages/error.css') !!}

  {!! Html::script('public/AdminTheme/app-assets/js/core/libraries/jquery.min.js') !!} 

  
</head>
<body class="vertical-layout vertical-menu 1-column bg-full-screen-image menu-expanded blank-page blank-page"
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
              <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0 pb-0">
                  <div class="card-title text-center">
                    <img src="../public/AdminTheme/app-assets/images/logo/logo-dark.png" alt="branding logo">
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Reset Forgot Password</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <div class="alert alert-success" id="verification_message" style="display: none;">
                 
                      <strong>Success!</strong> We have sent you a verification code on your email id, please check email inbox and reset your password.
                 
                    </div>
                    <form class="form-horizontal" name="resetpasswordForm" id="resetpasswordForm" method="POST">
                      
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" id="verification_code" name="verification_code" maxlength= "4" name="verification_code" class="form-control" placeholder="Verification code">
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>

                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" class="form-control" maxlength= "50" name="new_password" id="new_password" placeholder="New Password">
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>

                      <fieldset class="form-group position-relative has-icon-left">
                        <input  type="password" class="form-control"  maxlength= "50" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm New Password">
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                      </fieldset>

                      <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> Reset Password</button>
                    </form>
                  </div>
                  <div class="card-footer border-0">                  
                    <p class="float-sm-right text-center">Remembered Password ? <a href="{{ $app_url.'login' }}" class="card-link">Login</a></p>
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
  {!! Html::script('public/AdminTheme/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')!!}
  {!! Html::script('public/AdminTheme/app-assets/js/core/app-menu.js')!!}
  {!! Html::script('public/AdminTheme/app-assets/js/core/app.js')!!}
  {!! Html::script('public/AdminTheme/app-assets/js/core/libraries/jquery.validate.min.js')!!}

  {!! Html::script('public/AdminTheme/assets/js/scripts.js')!!}

  {!! Html::script('public/AdminTheme/app-assets/vendors/js/extensions/sweetalert.min.js') !!}
 
  {!! Html::script('public/AdminTheme/app-assets/js/scripts/extensions/sweet-alerts.js') !!}


<script type="text/javascript">
  
  var name = localStorage.getItem("forgot_email");
  //alert(name);
  if(name == "null"){

  }
  else if(name == "undefined"){
  }
  else{
    $('#verification_message').show();
  }
  
  $(document).ready(function(){
        
    $('#resetpasswordForm').validate({
    
      rules: {

        verification_code:{
                 
          digits: true,
          required : true
        },
        new_password: {
          required: true,
          minlength: 6
        },
        confirm_new_password: {
          required: true,
          equalTo: "#new_password"
        }
        
      },
     
      messages: {
       
        verification_code: {
                  required: "Please enter verification code.",

        },

        new_password: {
            required: "Please enter new password field.",
            minlength: "New Password minlength should be 6 character"
        },

        confirm_new_password: {
            required: "Please enter confirm password field.",
            equalTo: "Confirm password should be equal to new password.",
        },
      },
    
    
    submitHandler: function(form) {

      var code = $('#verification_code').val();
      var new_password = $('#new_password').val();
            
      if(name == "null"){
        swal({ 
          title: "Oops!",
          text:"Something is wrong." , 
          timer: 2000,
          showConfirmButton: false
        });
      }else{
    
        $.ajax({

           url: "{{url('api/reset-password')}}", 
           type: 'POST', 
           data: {'verification_code': code, 'password': new_password, 'email': name},
           headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
           success: function(res) {
            //console.log(res);
             med('add', 'submit', 'Redirecting');
          
             localStorage.removeItem("forgot_email");
             localStorage.setItem("remmeber_email",res.message);
             
             window.location.href = '{{url("admin/login")}}';
             
          },
          error: function(error){
            swal({
              title: "Oops!",
              text:" You have entered invalid verification code." , 
              timer: 2000, 
              showConfirmButton: false
            });
            // ajax_error(error);              
         
          }              

        });
      }

    }
 
  });
});

</script>
</body>
</html>
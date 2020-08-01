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
              <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0 pb-0">
                  <div class="card-title text-center">
                    
                  <!--   {!! Html::image('public/AdminTheme/app-assets/images/logo/enquiry.png', 'branding logo', ["style" => 'width:200px;']) !!} -->
                    <h2><b>{{Config::get('constants.PROJECT_TITLE')}}</b></h2>
                  
                  </div>
                  <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                    <span>Forgot Password</span>
                  </h6>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    <form class="form-horizontal" name="forgotpasswordForm" id="forgotpasswordForm" method="POST">
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="email" class="form-control " name= "email" id="email"
                        placeholder="Your Email Address" >
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
                        </div>
                      </fieldset>
                      <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> Reset Password</button>
                    </form>
                  </div>
                </div>
                 <div class="card-footer border-0">                  
                <p class="float-sm-right text-center">Remembered Password ? <a href="{{ $app_url.'login'}}" class="card-link">Login</a></p>
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
  
  $(document).ready(function(){
        
        $('#forgotpasswordForm').validate({
    

    rules: {

      email: {
        required: true,
      },
      
    },
   
    messages: {
     
      email: {
        required: "Please enter email.",
      },
    },
    
    
    submitHandler: function(form) {

      var email = $("#email").val();
      
      var data = {

        "email": email,
        'user_type': "1"
      
      };

      $.ajax({

            url: "{{url('api/forgot-password')}}", 
            method:'POST',
            dataType: 'JSON',
            data: data,
            headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
            success: function(res){
              //console.log(res);
              if(res.code === 200){
                
                localStorage.setItem("forgot_email", email);

                window.location.href = "{{$app_url.'reset-password'}}";
              
              }else{

              }
           
            },
            error: function(error){

               swal({
                  title: "Oops!",
                  text:"Your email id is not registered with us" ,
                  timer: 2000,
                  showConfirmButton: false
                });
              ajax_error(error);              
            }

      });

     }
 
  });
});

</script>
</body>
</html>
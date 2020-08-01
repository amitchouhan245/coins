@extends('Admin.layout.master')

@section('content')

<?php

  $app_url = url('/')."/".Request::segment('1')."/";

?>

<div class="app-content content">
   <div class="content-wrapper"> 
      <div class="content-header row">
         <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title">Change Password</h3>
            <div class="row breadcrumbs-top">
               <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                     </li>
                     <li class="breadcrumb-item active"><a href="#">Change Password</a>
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <section id="basic-form-layouts">
            <div class="row match-height">
               <div class="col-md-2"></div>
               <div class="col-md-8">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">Change Password</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>                 
                     </div>
                     <div class="card-content collapse show">
                        <div class="card-body">
                           <form class="form" id="changepasswordForm" method="">
                              <div class="form-body">
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="current_password">Current Password<i class="error"><strong>*</strong></i></label>
                                          <input type="password" id="current_password" class="form-control" placeholder="Current Password" name="current_password">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="new_password">New Password<i class="error"><strong>*</strong></i></label>
                                          <input type="password" id="new_password" class="form-control" placeholder="New Password" name="new_password">
                                       </div>
                                    </div>
                                 </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="new_password">Confirm Password<i class="error"><strong>*</strong></i></label>
                                          <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                                       </div>
                                    </div>
                                 </div>                             
                              </div>
                              <div class="form-actions" align="right">

                                 <a href="{{ $app_url .'dashboard'}}" class="btn btn-danger mr-1">
                                  <i class="ft-x"></i> Cancel
                                 </a>

                                 <button type="submit" class="btn btn-info">
                                 <i class="la la-check-square-o"></i> Submit
                                 </button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
</div>

@endsection

@section('script')

<script type="text/javascript">

  $(document).ready(function(){

    $('#changepasswordForm').validate({    

      rules: {
        
        current_password:{        
        
          required : true
        
        },

        new_password:{        
        
          required : true
        },

        confirm_password:{        
        
          required : true,
          equalTo: "#new_password"
        
        },              
      },
      messages: {

        current_password: {
        
          required: "The Current Password field is required.",
        },

        new_password: {
        
          required: "The New Password field is required.",
        },

        confirm_password: {
        
          required: "The Confirm Password field is required.",
          equalTo: "Confirm password should be equal to new password.",
        },
      },  
      submitHandler: function(form) {
         
        var data = {

          'current_password' : $('#current_password').val(),
          'new_password'     : $('#new_password').val(),
          'confirm_password' : $('#confirm_password').val(),
        };

        $.ajax({

          url: "{{url('api/change-password')}}", 
          type: 'POST', 
          data: data,
          headers : headers,
          success: function(res) {

            console.log(res);  
            ajax_success(res.message, APP_URL + "logout");            
          
          },          
          error: function(error){
            
            ajax_error(error);                            
          
          }       
        });
      }
    });
  });

</script>

@endsection

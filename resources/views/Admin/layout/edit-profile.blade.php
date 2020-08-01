@extends('Admin.layout.master')

@section('css')
  
  {!! Html::style('public/custom/plugnis/fancybox/source/jquery.fancybox.css') !!}
  
@endsection

@section('content')

<?php

  $app_url = url('/')."/".Request::segment('1')."/";
  $sessionArray = Session::get(Request::segment('1')); 

?>

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title">Edit Profile</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ $app_url .'dashboard' }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">Edit Profile</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <section id="basic-form-layouts">
          <div class="row match-height">
            <div class="col-md-1"></div>
              <div class="col-md-10">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Edit Profile</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>                 
                  </div>
                    <div class="card-content collapse show">
                      <div class="card-body">
                        <form class="form" id="profileForm" name ="profileForm" method="post" enctype="multipart/form-data" >
                          <input type="hidden" id="user_id" name="user_id" value="{{$profileInfo->id}}">
                          <div class="form-body">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="first_name">First Name<i class="error"><strong>*</strong></i></label>
                                  <input type="text" value="{{ $profileInfo['first_name'] }}" id="first_name" class="form-control" placeholder="First Name" name="first_name">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label for="last_name">Last Name<i class="error"><strong>*</strong></i></label>
                                  <input type="text" value="{{ $profileInfo['last_name'] }}" id="last_name" class="form-control" placeholder="Last Name" name="last_name">
                                </div>
                              </div>
                            </div>                     
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Email<i class="error"><strong>*</strong></i></label>
                                  <input  value="{{ @$profileInfo->email }}" id="email" class="form-control" placeholder="Email" name="email">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="country_code">Country Code<i class="error"><strong>*</strong></i></label>
                                      <input type="text" id="country_code" class = "form-control" placeholder = "Country Code" name="country_code" value="{{ get_area_code() }}" readonly>
                                    </div>
                                  </div>
                              <div class="col-md-6">
                                <label for="mobile_number">Mobile Number<i class="error"><strong>*</strong></i></label>
                                <input type="text" id="mobile_number" value="{{$profileInfo->mobile_number}}" class="form-control" placeholder="Mobile Number" name="mobile_number" maxlength="10">
                              </div>
                            </div>
                                                     
                            </div>
                            <div class="form-actions" align="right">
                               <a href="{{url(Request::segment(1).'/dashboard')}}" class="btn btn-danger mr-1">
                                <i class="ft-x"></i> Cancel
                               </a>
                               <button type="submit" id="submit" class="btn btn-info">
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

{!! Html::script('public/custom/plugnis/fancybox/source/jquery.fancybox.js') !!}

<script type="text/javascript">

  $(document).ready(function(){

    $('#profileForm').validate({    

      rules: {
        
        first_name:{ 

          required : true
        
        },

        last_name:{   

          required : true
        
        },
        email:{

          required : true  
        },

        mobile_number: {

          number: true,
          required: true,
          maxlength:10
        }

      },
      messages: {

        first_name: {
        
          required: "The First Name field is required.",
        },

        email: {
        
          required: "The email field is required.",
        },

        last_name: {
        
          required: "The Last Name field is required.",
        },
         mobile_number: {

          required: "The mobile number field is required",
          number: "Please enter only number.",
          maxlength: "Please enter only 10 digits",
        }
      },

      

      submitHandler: function(form) {
         
        med('add', 'submit', 'Please Wait..');       

        var params = $("#profileForm").serializeArray();

        var formData = new FormData();

        $.each(params,function (key, input) {

          formData.append(input.name, input.value);
        
        });

        formData.append('user_type' ,'1');

        //formData.append('_method', 'PUT');
        
        $.ajax({
          
          url: "{{ $app_url.'profile/'.$profileInfo->id  }}", 
          type: 'POST', 
          data: formData,
          headers  : headers,  
          cache: false,
          contentType: false,
          processData: false,
          success: function(res) {
            //console.log(res.result);
            ajax_success(res, "{{ $app_url.'dashboard' }}", 'submit');            
            set_session(res.result);
          },          
          error: function(error){            
            ajax_error(error, 'submit', '<i class="la la-check-square-o"></i> Add');
          }       
    
        });
    
      }

    });

    function set_session(info){
        
        data = {

          'id': info.id,
          'first_name': info.first_name,
          'last_name': info.last_name,
          'full_name': info.first_name+' '+info.last_name,
          'email': info.email,
          'password': info.password,
          'mobile_number': info.mobile_number,
          'profile_image': info.profile_image,
          'jwt_token': info.token,
          
        };

        $.ajax({

          url: "{{ url('admin/set-session') }}", 
          type: 'GET', 
          data: data,
          headers  : headers,
          success: function(res) {
            
            med('add', 'submit', 'Redirecting..'); 

            // window.location.href ="{{$app_url.'dashboard'}}";           

          },

          error:function(data){

            console.log(data);     

          }

        });

      }
});

</script>

<script type="text/javascript">
  $(".fancybox").fancybox();
</script>


@endsection

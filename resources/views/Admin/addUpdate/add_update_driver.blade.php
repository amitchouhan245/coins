@extends('Admin.layout.master')

@section('css')

  {!! Html::style('public/custom/css/animate.css') !!}

@endsection

@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title"><i class="la la-user"></i> {{ $title }}</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{$app_url.'dashboard'}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{$app_url.'users'}}">User</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">{{ $title }}</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
       <?php 

                                    $col_md_mobile = "col-md-2";
                                    $col_md = "col-md-4";

                                  ?>
      <div class="content-body">
         <section id="basic-form-layouts">
            <div class="row match-height">
               <div class="col-md-1"></div>
               <div class="col-md-10">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form"><i class="ft-plus-square"></i> {{ $title }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                     </div>
                     <div class="card-content collapse show">
                        <div class="card-body">
                          <form class="form" id="userForm" enctype="multipart/form-data"  method="post" action="javascript:void(0)">
                            <div class="form-body">
                              <h4 class="form-section"><i class="la la-user"></i>Driver Info</h4>
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="first_name">Name<i class="error"><strong>*</strong></i></label>
                                      <input type="text" id="name" class="form-control" placeholder="Name" name="name" maxlength="50" value="{{ ucfirst(@$users->name) }}">
                                    </div>
                                  </div>
                                <input type="hidden" name="user_type" id="user_type" value="2">
                                   <div class="{{ $col_md_mobile }}">
                                    <div class="form-group">
                                      <label for="country_code">Country Code<i class="error"><strong>*</strong></i></label>
                                      <input type="text" id="country_code" class = "form-control" placeholder = "Country Code" name="country_code" value="91" readonly>
                                    </div>
                                  </div>

                                  <div class="{{ $col_md }}">
                                    <label for="mobile_number">Mobile Number<i class="error"><strong>*</strong></i></label>
                                    <input type="text" id="mobile_number" class="form-control" placeholder="Mobile Number" name="mobile_number" maxlength="10" onkeyup="" value="{{ @$users->mobile_number }}">
                                    <input type="hidden" name="id" id="id" value="{{ @$users->id }}">
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="email">Email<i class="error"><strong>*</strong></i></label>
                                      <input type="text" id="email" class="form-control" placeholder="Email" name="email" maxlength="100" onkeyup="" value="{{ @$users->email }}">
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="email">Username<i class="error"><strong>*</strong></i></label>
                                      <input type="text" id="user_name" class="form-control" placeholder="Usernme" name="user_name" maxlength="100"  value="{{ @$users->user_name }}">
                                    </div>
                                  </div>

                                  
                                  @if(empty($users))

                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="email">Password<i class="error"><strong>*</strong></i></label>
                                        <input type="password" id="password" class="form-control" placeholder="Password" name="password" maxlength="100">
                                      </div>
                                    </div>
                                   
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="email">Confirm Password<i class="error"><strong>*</strong></i></label>
                                        <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password" maxlength="100">
                                      </div>
                                    </div>
                                                             
                                  @else
                                
                                  @endif
                               
                                </div>
                                <div class="form-actions" style="text-align: right;">
                                  <a href="{{$app_url.'users'}}" class="btn btn-danger mr-1">
                                    <i class="ft-x"></i> Cancel
                                  </a>
                                  <button type="submit" id="submit2" class="btn btn-info">
                                    <i class="la la-check-square-o"></i> Submit
                                  </button>
                                </div>
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

		$("#userForm").validate({

			rules: {

				name:{

					required : true
				},

				email: {

					required: true,
					email: true
				},

        user_name:{
          required :true
        },

				mobile_number: {

					number: true,
					required: true,
					maxlength:10
				},
			},

			messages: {

	       name: {

					required: "The name field is required",
				},

				email: {

					required: "The email field is required",
					email: "Please enter a valid email address",
				},

				password: {

					required: "The password field is required",
				},

				mobile_number: {

					required: "The mobile number field is required",
					number: "Please enter only number.",
					maxlength: "Please enter only 10 digits"
				},
			},

			submitHandler: function(form) {

        med('add', 'submit2', 'Please Wait..');
        var params = $(form).serializeArray();
        var id = "{{ @$users->id }}";
        
        if(id != ''){
          
          var webUrl = "{{ $app_url.'users/'.@$users->id }}";
          var method = 'PUT';

        } else {

          var webUrl = "{{ $app_url.'users' }}";
          var method = 'POST';
        }

				$.ajax({

					url: webUrl,
          type: method,
					data: params,
					headers  : headers,
					
					success: function(res) {

						ajax_success(res, '{{ $app_url."drivers" }}', 'submit2');
            
          },
					error: function(error){
						
						ajax_error(error, 'submit', '<i class="la la-check-square-o"></i> Add');
					}
				});
			}
		});
	});

</script>


@endsection


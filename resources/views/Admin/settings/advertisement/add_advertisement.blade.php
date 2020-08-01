@extends('Admin.layout.master')

@section('content')

<div class="app-content content"> 
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"><i class="la la-desktop"></i>{{ $title }}</h3>
            <div class="row breadcrumbs-top">
             <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ $app_url.'Advertisement' }}">Advertisement</a>
                     </li>
                     <li class="breadcrumb-item active"><a href="#">{{ $title }}</a>
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
                  
                     <div class="card-content collapse show">
                        <div class="card-body">
                           <form class="form" id="addContentForm" method="POST">
                              <div class="form-body">
                                 <h4 class="form-section"><i class="la la-desktop"></i>Advertisement- Info</h4>
                                 <div class="row">
                                 <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="type">Title<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="title" class="form-control" placeholder="title" name="title">
                                       </div>
                                    </div>



                                  <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="type">Link<i class="error"><strong></strong></i></label>
                                          <input type="text" id="url" class="form-control" placeholder="link" name="url">
                                       </div>
                                    </div>

                                      <div class="col-md-4">
                                       <div class="form-group">
                                          <label for="type">Type<i class="error"><strong>*</strong></i></label>
                                          <input type="type" id="type" class="form-control" placeholder="type" name="type">
                                       </div>
                                    </div>
                                    
                                   
                                    <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="value">Description<i class="error"><strong>*</strong></i></label>
                                                        <textarea name="description" id="description" placeholder="Enter Description here" cols="3" rows="2" class="form-control form-group">{{ @$category->description }}</textarea>
                                                    </div>
                                                </div>

                                            </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="custom-file">
                                                    <label for="image">Advertisement Image <i class="error"><strong>( JPEG ,JPG or PNG formate )</strong></i></label>
                                                    <br>
                                                    <input type="file" id="image"  name="image"  >
                                                </div>
                                            </div>

                                        </div>

                                    <div class="col-md-12" id="error_message"></div>
                                        
              





                                 </div>
                              
                              <div class="form-actions" align="right">
                                 <a href="{{ $app_url.'Advertisement' }}" class="btn btn-danger mr-1">
                                    <i class="ft-x"></i> Cancel</a>
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


  {!! Html::script('public/AdminTheme/app-assets/vendors/js/editors/ckeditor/ckeditor.js')!!}

<script type="text/javascript">

  $(document).ready(function(){

    $('#addContentForm').validate({

      rules: {
         
          title:{
            required : true
          },        
          url:{
            url:true,
          //  required : true
          },
          description:{
             required : true
          },
          type:{
             required : true
          },
      },
      messages: {

        title: {

          required : "Please enter title.",
        },
        url: {

          required: "Please enter url.",
        },
        value: {

          required: "Please enter description.",
        },
        type: {

          required: "Please enter type.",
        },
      },

       
      submitHandler: function(form) { 

      let btnText = '<i class="la la-check-square-o"></i> Add';
      let btnId   = 'submit';
      // med('add', btnId);
      var params = $(form).serializeArray();
      var files = $("#image")[0].files[0];
      var formData = new FormData();

      formData.append('image', document.getElementById("image").files[0]);

      $.each(params,function (key, input) {

        formData.append(input.name, input.value);
      
      });
  
        $.ajax({
       
          url      : APP_URL + 'storeadvertise',
          type     : 'POST', 
          data     : formData,
          headers  : headers,
          cache: false,
          contentType: false,
          processData: false,
          success: function(res) {

            ajax_success(res, APP_URL + 'Advertisement', btnId, btnText);

          },
          error: function(error){
          
           ajax_error(error, btnId, btnText);              
          
          }

        });

      } 

    });

  });

</script>

@endsection

    
               
             


                                
          
  

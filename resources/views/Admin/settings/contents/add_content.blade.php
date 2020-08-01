@extends('Admin.layout.master')

@section('content')

<div class="app-content content"> 
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"><i class="la la-gear"></i>{{ $title }}</h3>
            <div class="row breadcrumbs-top">
             <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ $app_url.'contents' }}">Contents</a>
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
                                 <h4 class="form-section"><i class="la la-gear"></i>Content - Info</h4>
                                 <div class="row">
                                 <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="type">Title<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="title" class="form-control" placeholder="Type" name="title">
                                       </div>
                                    </div>

                                  <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="type">Type<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="type" class="form-control" placeholder="Type" name="type">
                                       </div>
                                    </div>
                                    
                                      <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="value">English<i class="error"><strong>*</strong></i></label>
                                           <textarea name="eng_ckeditor" id="eng_ckeditor" cols="30" rows="15" class="ckeditor">
                                          </textarea> 
                                       </div>
                                    </div>


                                      <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="value">Arabic<i class="error"><strong>*</strong></i></label>
                                           <textarea name="arb_ckeditor" id="arb_ckeditor" cols="30" rows="15" class="ckeditor">
                                          </textarea> 
                                       </div>
                                    </div>


                                    <div class="col-md-12" id="error_message"></div>
                                 </div>
                              </div>
                              <div class="form-actions" align="right">
                                 <a href="{{ $app_url.'contents' }}" class="btn btn-danger mr-1">
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
         type:{
             required : true
          },
          eng_ckeditor:{
             required : true
          },
          arb_ckeditor:{
             required : true
          },
          

      },
      messages: {

        title: {

           required : "Please enter title.",
          },
        type: {
            
            required: "Please enter type.",
          },
         
      },  
       
      submitHandler: function(form) { 

        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        
        med('add', btnId);

        var oFormData = $('#addContentForm').serializeArray();
        var engMessage = CKEDITOR.instances['eng_ckeditor'].getData();
        var arbMessage = CKEDITOR.instances['arb_ckeditor'].getData();
       
        $.ajax({
       
          url      : APP_URL + 'contents',
          type     : 'POST', 
          data     : oFormData,
          headers  : headers,
          success: function(res) {

            ajax_success(res, APP_URL + 'contents', btnId, btnText);
         
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

    
               
             


                                
          
  

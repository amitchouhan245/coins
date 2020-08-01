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
                     <li class="breadcrumb-item"><a href="{{ $app_url.'configuration'}}">Configuration</a>
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
                           <form class="form" id="editConfigurationForm" method="PUT">
                              <div class="form-body">
                                 <h4 class="form-section"><i class="la la-gear"></i>Configuration Info</h4>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="type">Title<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="title" class="form-control" placeholder="Title" value="{{ ucfirst(@$configuration->title) }}" name="title">
                                       </div>
                                    </div>
                                      <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="type">Type<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="type" class="form-control" placeholder="Type" value="{{ $configuration->type }}" name="type">
                                          <ul id="note" class="text-danger">*Only change by devloper.</ul>
                                       </div>

                                    </div>

                                      <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="value">Value<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="value" class="form-control" placeholder="Value" value="{{ ucfirst($configuration->value) }}" name="value">
                                       </div>
                                    </div>
                                    
                                   
                                    <div class="col-md-12" id="error_message"></div>
                                 </div>
                              </div>
                              <div class="form-actions" align="right">
                                 <a href="{{ $app_url. 'configuration' }}" class="btn btn-danger mr-1">
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

<script type="text/javascript">

  $(document).ready(function(){

    $('#editConfigurationForm').validate({

      rules: {
        
        title: {
            required : true
        },
        type:{
             required : true
          },
        value:{
             required : true
          },
         
      },
      messages: {

        title: {
            
            required: "Please enter type.",
          },
        type: {
            
            required: "Please enter type.",
          },
        value: {

          required: "Please enter value.",
        },

        
      },  
       
      
      submitHandler: function(form) { 

        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        
        med('add', btnId);

        var oFormData = $('#editConfigurationForm').serializeArray();

        $.ajax({
       
          url      : APP_URL + "{{ 'configuration/'.$configuration->id }}",
          type     : 'PUT', 
          data     : oFormData,
          headers  : headers,
          success: function(res) {

            ajax_success(res, APP_URL + 'configuration', btnId, btnText);
         
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

    
               
             


                                
          
  

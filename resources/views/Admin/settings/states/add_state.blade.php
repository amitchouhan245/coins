@extends('Admin.layout.master')

@section('content')

<div class="app-content content"> 
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"><i class="la la-flag-o"></i>{{ $title }}</h3>
            <div class="row breadcrumbs-top">
             <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ $app_url.'states' }}">States</a>
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
                           <form class="form" id="addStateForm" method="POST">
                              <div class="form-body">
                                 <h4 class="form-section"><i class="la la-flag-o"></i>State Info</h4>
                                 <div class="row">
                                    
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="state_name">Select Country<i class="error"><strong>*</strong></i></label>
                                         <select class="select2 form-control" id="country_id" name="country_id" >
                                             <option value="">Select Country</option>
                                             
                                             @foreach($country as $value)

                                              <option value="{{ $value->id }}">
                                              
                                                {{ $value->country_name }}
                                              
                                              </option>

                                            @endforeach

                                          </select>
                                       </div>
                                    </div> 

                                      <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="country_name">State Name<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="state_name" class="form-control" placeholder="State Name" name="state_name">
                                       </div>
                                    </div>

                                    <div class="col-md-12" id="error_message"></div>
                                 </div>
                              </div>
                              <div class="form-actions" align="right">
                                 <a href="{{ $app_url.'states' }}" class="btn btn-danger mr-1">
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

    $('#addStateForm').validate({

      rules: {
          country_id:{
             required : true
          },
          state_name:{        
              required : true
           },
      },
      messages: {

        country_id: {

          required: "Please select country.",
        },

        state_name: {
            
            required: "Please enter state name.",
          },
      },  
       errorPlacement: function(error, element){

         if(element.attr("name") == "country_id") {

          error.appendTo( element.next() );

         }else {

          error.insertAfter(element);
         }
      },  
      
      submitHandler: function(form) { 

        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        
        med('add', btnId);

        var oFormData = $('#addStateForm').serializeArray();

        $.ajax({
       
          url      : "{{ $app_url.'states' }}",
          type     : 'POST', 
          data     : oFormData,
          headers  : headers,
          success: function(res) {

            ajax_success(res, "{{ $app_url.'states' }}", btnId, btnText);
         
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

    
               
             


                                
          
  

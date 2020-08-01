@extends('Admin.layout.master')

@section('content')

<div class="app-content content"> 
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"><i class="la la-flag-checkered"></i>{{ $title }}</h3>
            <div class="row breadcrumbs-top">
             <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ $app_url.'cities' }}">Cities</a>
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
                           <form class="form" id="addCityForm" method="POST">
                              <div class="form-body">
                                 <h4 class="form-section"><i class="la la-flag-checkered"></i>City Info</h4>
                                 <div class="row">
                                    
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="state_name">Select Country<i class="error"><strong>*</strong></i></label>
                                         <select class="select2 form-control" id="country_id" name="country_id" onchange="select_state();">
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
                                          <label for="state_name">Select State<i class="error"><strong>*</strong></i></label>
                                         <select class="select2 form-control" id="state_id" name="state_id">
                                             <option value="">Select State</option>
                                          </select>
                                       </div>
                                    </div> 
                                      <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="city_name">City Name<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="city_name" class="form-control" placeholder="City Name" name="city_name">
                                       </div>
                                    </div>

                                    <div class="col-md-12" id="error_message"></div>
                                 </div>
                              </div>
                              <div class="form-actions" align="right">
                                 <a href="{{ $app_url.'cities' }}" class="btn btn-danger mr-1">
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

    $('#addCityForm').validate({

      rules: {
          country_id:{
             required : true
          },

          state_id:{
             required : true
          },
                    
          city_name:{        
              required : true
           },
      },
      messages: {

        country_id: {

          required: "Please select country.",
        },

        state_id: {

          required: "Please select state.",
        },

        city_name: {
            
            required: "Please enter city name.",
        },
      },  
       errorPlacement: function(error, element){

         if(element.attr("name") == "country_id") {

          error.appendTo( element.next() );
         
         }else if(element.attr("name") == "state_id") {

          error.appendTo( element.next() );
         
         }else {

          error.insertAfter(element);
         }
      },  
      
      submitHandler: function(form) { 

        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        
        med('add', btnId);

        var oFormData = $('#addCityForm').serializeArray();

        $.ajax({
       
          url      : APP_URL + 'cities',
          type     :'POST', 
          data     : oFormData,
          headers  : headers,
          success: function(res) {

            ajax_success(res, APP_URL +'cities', btnId, btnText);
         
          },
          error: function(error){
          
            ajax_error(error, btnId, btnText);              
          
          }

        });

      } 

    });

  });

  function select_state(){

    var countryId = $('#country_id').val();

    $.ajax({

      url  :APP_URL + 'states-list',
      data : { "country_id" : countryId },
      dataType : "JSON",
      headers: headers,

      success : function (res){
      
        var options = '<option value="">Select State</option>';

        if (res.code === 200) {

          for (var i = 0; i < res.result.length; i++) {
            
            options = options + '<option value="'+res.result[i].id+'" sId="'+res.result[i].id+'">'+res.result[i].state_name+'</option>';
          } 
        }
        $("#state_id").html(options);

      },
      error: function(error) {

        $("#state_id").html('<option value="">States not found</option>');
        
      }
    })
  }

</script>

@endsection

    
               
             


                                
          
  

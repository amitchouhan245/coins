@extends('Admin.layout.master')

@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title"><i class="la la-mobile-phone"></i>{{ $title }}</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{$app_url.'dashboard'}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">{{ $title }}</a>
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
                          <form class="form" id="appInfoForm" method="post" action="javascript:void(0)">
                            <div class="form-body">
                              <h4 class="form-section"><i class="la la-mobile-phone"></i>App Info</h4>
                                <div class="row">
                                  <input type="hidden" name="appInfo_id" id="appInfo_id" value="{{ @$appData->id }}">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="base_charges">Contact Number<i class="error"><strong>*</strong></i></label>
                                      <input type="text" id="contact_number" class="form-control" placeholder="Contact Number" name="contact_number" value="{{ @$appData->contact_number }}" maxlength="10">
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="last_name">Email<i class="error"><strong>*</strong></i></label>
                                      <input type="text" id="email" class="form-control" placeholder="Email" name="email" value="{{ @$appData->email }}">
                                    </div>
                                  </div>
                                    <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="email">Web Url<i class="error"><strong>*</strong></i></label>
                                      <input type="text" id="web_url" class="form-control" placeholder="Web Url" name="web_url" value="{{ @$appData->web_url }}" >
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label for="email">Address<i class="error"><strong>*</strong></i></label>
                                    <textarea class="form-control" name="address"  rows="1" placeholder="Address">{{ @$appData->address }}</textarea> 
                                    </div>
                                  </div>
                                </div>
                              
                                <div class="form-actions" style="text-align: right;">
                                  <a href="{{$app_url.'dashboard'}}" class="btn btn-danger mr-1">
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

    $('#appInfoForm').validate({

      rules: {
          contact_number:{
             required : true,
             number: true,
             maxlength:10

          },

          email:{
             required : true,
             email: true
          },
                    
          web_url:{        
              required : true,
              url: true
          },
          address:{

            required : true
          }
      },
      messages: {

        contact_number: {

          required: "Please enter Contact Number.",
          number: "Please enter Contact Number.",
          maxlength: "Please enter only 10 digits"

        },

        email: {

          required: "Please enter email."
        },

        web_url: {
            
            required: "Please enter url."
        },
        address: {

            required: "Please enter Address."
        },
      },  
 
      
      submitHandler: function(form) { 

        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        
        med('add', btnId);

        var oFormData = $('#appInfoForm').serializeArray();

        $.ajax({
       
          url      :'{{ $app_url.'update-app-info' }}',
          type     :'POST', 
          data     : oFormData,
          headers  : headers,
          success: function(res) {

           swal(res.message, { icon: "success", timer: 2000});
           setTimeout(function(){ location.reload(); }, 2000);
         
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


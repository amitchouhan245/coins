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
                           <form class="form" id="replyForm" method="POST">
                              <div class="form-body">
                                 <h4 class="form-section"><i class="la la-gear"></i>Support</h4>
                                 <div class="row">
                                 <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="type">TO <i class="error"><strong></strong></i></label>
                                          <input type="text" id="user" class="form-control" placeholder="User Name" name="user" readonly="true" value="{{ @$support->fromUser->first_name }}">
                                       </div>
                                    </div>

                                      <div class="col-md-12">
                                       <div class="form-group">
                                         <label for="type">Message <i class="error"><strong></strong></i></label>
                                      <p><mark style="font-style:italic">{{ @$support->message }}</mark></p>
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="value">Reply <i class="error"><strong>*</strong></i></label>
                                           <textarea class="form-control" placeholder="Enter Message here" id="message" name="message" rows="5"></textarea>
                                       </div>
                                    </div>
                                   

                                    
                                      

                                   <input type="hidden" name="to_id" id="to_id" value="{{ @$support->from_id }}">
                                   <input type="hidden" name="user_id" id="user_id" value="{{ @$support->to_id }}">

                                   <input type="hidden" name="id" id="id" value="{{ @$support->id }}">
                                   
                                 </div>
                              </div>
                              <div class="form-actions" align="right">
                                 <a href="{{ $app_url.'support-list' }}" class="btn btn-danger mr-1">
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

    $('#replyForm').validate({

      rules: {
         
        message:{
            
          required : true
        },
      },
      messages: {

        message: {

          required : "Please enter message.",
        
        },
      },  
       
      submitHandler: function(form) { 

        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        
        med('add', btnId);

        var oFormData = $('#replyForm').serializeArray();

        $.ajax({
       
          url      : APP_URL + 'reply-support',
          type     : 'POST', 
          data     : oFormData,
          headers  : headers,
          success: function(res) {

            ajax_success(res, APP_URL + 'support-list', btnId, btnText);
         
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

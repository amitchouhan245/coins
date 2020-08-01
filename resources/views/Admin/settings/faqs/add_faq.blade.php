@extends('Admin.layout.master')

@section('css')

  {!! Html::style('public/custom/css/animate.css') !!}

@endsection

@section('content')

<div class="app-content content"> 
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"><i class="ft-list"></i> {{ $title }}</h3>
            <div class="row breadcrumbs-top">
             <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ $app_url.'faqs' }}">FAQ</a>
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
                           <form class="form" id="addFaqForm" method="POST">
                              <div class="form-body">
                                 <h4 class="form-section"><i class="ft-list"></i>FAQ</h4>

                                 <div class="row">
                                      <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="city_name">Question<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="question" class="form-control" placeholder="Enter Question" name="question">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for='School'>Answer<i class="error"><strong>*</strong></i></label>
                                          <textarea class="form-control" placeholder="Enter Answer here" id="answer" name="answer"></textarea>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-actions" align="right">
                                 <a href="{{ $app_url.'faqs'}}" class="btn btn-danger mr-1">
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

    $('#addFaqForm').validate({

      rules: {
          question:{
             required : true
          },

          answer:{
             required : true
          },
      },
      messages: {

        question: {

          required: "Please enter question.",
        },

        answer: {

          required: "Please enter answer.",
        },
      },  

       errorPlacement: function(error, element){

         if(element.attr("question") == "type") {

          error.appendTo( element.next() );
         
         }else {

          error.insertAfter(element);
         }
      },  
      
      submitHandler: function(form) { 

        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        
        med('add', btnId);

        var oFormData = $('#addFaqForm').serializeArray();

        $.ajax({
       
          url      :'{{ $app_url.'faqs' }}',
          type     :'POST', 
          data     : oFormData,
          headers  : headers,
          success: function(res) {

            ajax_success(res, '{{ $app_url.'faqs'}}', btnId, btnText);
         
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



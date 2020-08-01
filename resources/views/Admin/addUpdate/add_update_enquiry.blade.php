@extends('Admin.layout.master')

@section('css')

  {!! Html::style('public/custom/plugnis/fancybox/source/jquery.fancybox.css') !!}

@endsection

@section('content')

<div class="app-content content"> 
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"><i class="la la-legal"></i> {{ $title }}</h3>
            <div class="row breadcrumbs-top">
             <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ $app_url.'enquiries' }}">Enquiries</a>
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
               <div class="col-md-1"></div>
               <div class="col-md-10">
                  <div class="card">
                  
                     <div class="card-content collapse show">
                        <div class="card-body">
                           <form class="form" id="addCategoryForm" >
                              <div class="form-body">
                                 <h4 class="form-section"><i class="la la-legal"></i>Enquiry</h4>
                                 <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="type">First Name<i class="error"><strong>*</strong></i></label>
                                      <input type="text" id="first_name" class="form-control" placeholder="First Name" name="first_name" value="{{ @$enquiry_data->user->first_name }}">
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="type">Last Name<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="last_name" class="form-control" placeholder="Last Name" name="last_name" value="{{ @$enquiry_data->user->last_name }}">
                                       </div>
                                    </div>
                                    
                                      <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="value">Mobile Number<i class="error"><strong>*</strong></i></label>
                                          <input type="text" id="mobile_number" class="form-control" placeholder="Mobile Number" name="mobile_number" value="{{ @$enquiry_data->user->mobile_number }}" maxlength="10"> 
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label for="value">Address<i class="error"><strong>*</strong></i></label>
                                           <textarea name="address" id="address" placeholder="Enter Address here" cols="1" rows="1" class="form-control form-group">{{ @$enquiry_data->description }}</textarea> 
                                       </div>
                                    </div>
                                        <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="value">Description<i class="error"><strong>*</strong></i></label>
                                           <textarea name="description" id="description" placeholder="Enter Description here" cols="2" rows="2" class="form-control form-group">{{ @$enquiry_data->description }}</textarea> 
                                       </div>
                                    </div>

                                      <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="value">Category<i class="error"><strong>*</strong></i></label>
                                        <select id="category_id" name="category_id" class="select2 form-control" onchange="get_category_document();">
                                          <option value="">Select Category</option>
                                          @foreach($categories as $value)
                                          <?php
                                            $s = '';

                                            if (!empty(@$enquiry_data->category_id)) {
                                              
                                              if ($value['id'] == $enquiry_data['category_id']) {
                                                
                                                $s = 'selected';
                                              
                                              }
                                            }
                                          ?>
                                          <option value="{{ $value['id']}}" {{$s}}>{{ $value['title']}}</option>
                                          @endforeach
                                        </select>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              @if(!empty($enquiry_data))

                                <input type="hidden" name="enquiry_id" id="enquiry_id" value="{{ @$enquiry_data->id }}">

                              @endif
                                  
                                <br>

                                <div  class="row">
                                
                                  <div class="col-md-1"></div>
                                  <div id="form_append" class="col-md-12"></div>
                                  
                                </div>

                                  @php

                                    $instruction_no = 0;

                                  @endphp

                                <div class="form-actions" align="right">

                                  <a href="{{ $app_url.'enquiries' }}" class="btn btn-danger mr-1">

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

{!! Html::script('public/custom/plugnis/fancybox/source/jquery.fancybox.js') !!}

<script type="text/javascript">

  var countAppend = 0;  

  $(document).ready(function(){

    $('#addCategoryForm').validate({

      rules: {
         
         first_name:{
             required : true
          },        
         last_name:{
             required : true
          },
          mobile_number:{
             required : true,
             number : true
          },
          address:{

             required : true
          },
          description:{

            required : true
          },
          category_id:{

             required : true
          },
      },
      messages: {

        first_name: {

           required : "Please enter first name.",
          },
        last_name: {
            
            required: "Please enter last name.",
          },
        mobile_number: {
            
            required: "Please enter mobile number.",
          },
        address : {

          required: "Please enter Address",
        },
        description:{

          required: "Please enter description",

        },
        category_id:{

          required: "Please select category",

        },
      },  

      errorPlacement: function(error, element){

        if(element.attr("name") == "category_id") {

          error.appendTo( element.next() );

        }else {

          error.insertAfter(element);
        }
      },  
       
      submitHandler: function(form) { 

        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        
        med('add', btnId);

        var params = $(form).serializeArray();
        var formData = new FormData();

        for(var i =  0 ; i <= countAppend; i++) {

          var files = $("#image"+i)[0].files[0];

          formData.append('image_json['+i+'][image]', document.getElementById("image"+i).files[0]);
        }

        $.each(params,function (key, input) {

          formData.append(input.name, input.value);

        });

        $.ajax({
       
          url      : APP_URL + 'enquiries',
          type     : 'POST', 
          data     : formData,
          headers  : headers,
          cache: false,
          contentType: false,
          processData: false,
          success: function(res) {

            ajax_success(res, APP_URL + 'enquiries', btnId, btnText);
          },
          error: function(error){
          
            ajax_error(error, btnId, btnText);              
          }
        });
      } 
    });

    var blockCount = "{{$instruction_no}}";  
       
    if(blockCount == 0){

      // add_period_element('class_period_element');
      // add_validation_new(2);
    }
  });

  $(".fancybox").fancybox();

  </script>

  <script type="text/javascript">
  
  function get_category_document() {

    var categoryId = $('#category_id').val() ;
    var enquiryId = "{{ @$enquiry_data->id }}";
    
    if( categoryId != '') {
   
      $.ajax({

        url  : "{{  $app_url.'get-category-document'  }}",
        method: 'GET',
        data : { "category_id": categoryId, "enquiry_id":enquiryId },
        dataType : "JSON",
        headers: headers,

        success: function(res) {  

          if (res.code === 200) {

            var option = '';

            for (var i = 0; i < res.result.category_documents.length; i++) {
              
              var red  = res.result.category_documents;
              
              if(red[i].enquiry_document != undefined) {

                 var doc_imge = res.result.category_documents[i].enquiry_document.document_image;

                 var ImagePath = "{{url(Config::get("constants.ENQUIRY_DOCUMENT_THUMBNAIL"))}}";

                 var ShowImage =  ImagePath+'/'+doc_imge;

                 option = option + 
                    '<div class="row">'+
                    '<div class="col-md-6">'+
                      '<div class="custom-file">'+
                        '<label for="profile_image">'+ res.result.category_documents[i].document_name +'<i class="error"><strong>  ( JPEG ,JPG or PNG format )</strong></i></label>'+
                        '<br>'+

                        '<input class="" type="file" id="image'+i+'" name="image['+i+']" >'+
                         '<input  class="form-control" type="hidden"  name="image_json['+i+'][category_document_id]" value="'+res.result.category_documents[i].id+'">'+

                         '<input type = "hidden" value= "'+res.result.category_documents[i].enquiry_document.id+'" name="image_json['+i+'][enquiry_document_id]">'+  

                      '</div>'+
                    '</div>'+
                    '<div class="col-md-6">'+
                      '<a class="fancybox" href='+ShowImage+'>'+
                      '<img src='+ShowImage+' class="" style="width:70px;height:70px;" alt="">'+
                      '</a><br/><br/>'+
                    '</div>'+
                    '</div>'+
                  '<br>'+
                '<br>';

                countAppend = i ;   

              }else{
                
                option = option + 

                    '<div class="">'+
                      '<div class="custom-file">'+
                        '<label for="profile_image">'+ res.result.category_documents[i].document_name +'<i class="error"><strong>  ( JPEG ,JPG or PNG formate )</strong></i></label>'+
                        '<br>'+
                        '<input class="" type="file" id="image'+i+'" name="image['+i+']" >'+
                         '<input  class="form-control" type="hidden"  name="image_json['+i+'][category_document_id]" value="'+res.result.category_documents[i].id+'">'+
                      '</div>'+
                    '</div>'+
                  '<br>'+
                '<br>';

                countAppend = i ;   
              }
            } 
              $("#form_append").html(option);
          }
         //   add_validation_new(countAppend);
        },   

        error: function(error){

          ajax_error(error);              

        } 
        
      });

    }else{
      
      $("#form_append").html('');
    } 
  }

  function add_validation_new(instruction_no) {

    for(var k = 0 ; k <= instruction_no; k++ ) {

      $("#image"+k).rules("add", {

        required:true,

        messages: {

          required: "Please Upload Image",
        }
      });
    }
  }

get_category_document();  

</script>

@endsection
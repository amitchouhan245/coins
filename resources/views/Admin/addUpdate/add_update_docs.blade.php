@extends('Admin.layout.master')

@section('css')

  {!! Html::style('public/custom/css/animate.css') !!}

@endsection

@section('content')

<?php

  $sessionArray = Session::get(Request::segment('1')); 
   
?>

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title"><i class="ft-image"></i> {{ $title }}</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{$app_url.'dashboard'}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{url('admin/categories')}}">Services</a>
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
                     <div class="card-header">
                      <h4 class="card-title" id="basic-layout-form"><i class="ft-plus-square"></i> {{ $title }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                     </div>
                     <div class="card-content collapse show">
                        <div class="card-body">
                          <form class="form" id="addNoticeForm" enctype="multipart/form-data"  method="post" action="javascript:void(0)">
                            <div class="form-body">
                              <h4 class="form-section"><i class="la la-image"></i> Attached Docs</h4>
                                <div class="row">
                                    <input type="hidden" name="category_id" id="category_id" value="{{ @$category_id }}">
                                    <div class="col-md-10">
                                      <div class="form-group">
                                        <label for="title">Title<i class="error"><strong>*</strong></i></label>
                                        <input type="text" id="title" class="form-control" placeholder="Enter full name" name="title" maxlength="100" value="{{ ucfirst(@$imageData->title) }}" >
                                      </div>
                                  </div>
                                  <div class="col-md-10">
                                    <div class="custom-file">
                                      <label for="profile_image">Attached Doc <i class="error"><strong>( JPEG ,JPG or PNG formate )</strong></i></label>
                                      <br>
                                      <input type="file" id="image"  name="image"  >
                                    </div>

                                    @if(@$imageData->image !="" && file_exists(Config::get('constants.BANNER_THUMBNAIL').@$imageData->image))
                                  
                                    <div class="col-md-10" style="height: 20px;"></div>
                                      <a  class = "fancybox" href="{{url(Config::get('constants.BANNER_THUMBNAIL').$imageData->image )}}" >
                                    {!! Html::image(Config::get('constants.BANNER_THUMBNAIL').$imageData->image,'',['alt' => 'Images','class' => '',"style" => 'width:70px;height:70px;'])!!} </a><br/><br/>

                                  @else

                                    {!! Html::image('public/uploads/no-image.png', '', ['class' => '',"style" => 'width:70px;height:70px;']) !!}
                                    
                                  @endif
                                  </div>
                                </div>
                                <div class="form-actions" style="text-align: right;">
                                   <a href="{{$app_url.'categories/'.$category_id}}" class="btn btn-danger mr-1">
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

  {!! Html::script('public/custom/plugnis/bootstrap-date-time-picker/bootstrap_moment.js') !!}
  {!! Html::script('public/custom/plugnis/bootstrap-date-time-picker/bootstrap_datetimepicker.js') !!}

<script type="text/javascript">

  $(document).ready(function(){

    //var regex = "/^[0-9]{6}(\.[0-9]{1,2})?$";

    $("#addNoticeForm").validate({

      rules: {

        title:{

          required:true,
        },
        image: {
          required: true,
      //    pattern:  '([a-zA-Z0-9\s_\\.\-:])+(.png|.jpg|.gif)$',

        },
     },

     messages: {

      title:{

        required:"The title field is required",
      },
      image: {

        required: "The Image field is required",
      },   
    },
     // errorPlacement: function(error, element){

     //    if(element.attr("name") == "image") {

     //      error.appendTo( element.next() );

     //    }else { 

     //      error.insertAfter(element);
     //    }
     //  }, 
 
    submitHandler: function(form) {

      med('add', 'submit2', 'Please Wait..');
      var params = $(form).serializeArray();
      var files = $("#image")[0].files[0];
      var formData = new FormData();
      formData.append('image', document.getElementById("image").files[0]);

      $.each(params,function (key, input) {

          formData.append(input.name, input.value);
      });

      $.ajax({

        url: "{{ $app_url.'store-category-attached' }}",
        type: 'POST',
        data: formData,
        headers  : headers,
        cache: false,
        contentType: false,
        processData: false,
        success: function(res) {

          ajax_success(res, '{{ $app_url."categories/".$category_id}}', 'submit2');
        
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


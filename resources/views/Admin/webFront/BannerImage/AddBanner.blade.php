@extends('Admin.layout.master')

@section('css')

  {!! Html::style('public/custom/plugnis/fancybox/source/jquery.fancybox.css') !!}

@endsection

@section('content')

<div class="app-content content"> 
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"><i class="ft-image"></i>{{ $title }}</h3>
            <div class="row breadcrumbs-top">
             <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{ $app_url.'categories' }}">Categories</a>
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
                           <form class="form" id="addBannerForm" >
                              <div class="form-body">
                                 <h4 class="form-section"><i class="ft-image"></i>Banner Image</h4>
                                 <div class="row">

                                   <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="type">Title<i class="error"><strong>*</strong></i></label>
                                        <input type="text" id="title" class="form-control" placeholder="Title" name="title" value="{{ @$bannerImages->title }}">
                                      </div>
                                    </div>

                                    
                                      
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="value">Description<i class="error"><strong>*</strong></i></label>
                                          <textarea name="description" id="description" placeholder="Enter Description here" cols="3" rows="2" class="form-control form-group">{{ @$bannerImages->description }}</textarea> 
                                      </div>
                                    </div>

                                  </div>
                              </div>
                              @if(!empty($bannerImages))
                              <input type="hidden" name="id" id="id" value="{{ @$bannerImages->id }}">
                              @endif

                               <div class="row">
                                  <div class="col-md-8">
                                    <div class="custom-file">
                                      <label for="profile_image">Banner Image <i class="error"><strong>( JPEG ,JPG or PNG formate )</strong></i></label>
                                      <br>

                                      <input type="file" id="image"  name="image" >
                                    </div>
                                  </div>
                              
                              @if(@$bannerImages['image'] !="" && file_exists(Config::get('constants.BANNER_THUMBNAIL').@$bannerImages->image))

                                <a class="fancybox" href="{{url(Config::get('constants.BANNER_THUMBNAIL').$bannerImages->image )}}" >
                                {!! Html::image(Config::get('constants.BANNER_THUMBNAIL').$bannerImages->image,'',['alt' => 'Images','class' => '',"style" => 'width:70px;height:70px;'])!!} </a><br/><br/>

                              @else

                              @if(!empty(@$bannerImages->id))

                                {!! Html::image('public/uploads/no-image.png', '', ['class' => '',"style" => 'width:70px;height:70px;']) !!}
                              
                              @endif
                              
                              @endif
                                </div>  
                              <div class="form-actions" align="right">
                                 <a href="{{ $app_url.'banner-images' }}" class="btn btn-danger mr-1">
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

    $('#addBannerForm').validate({

      rules: {
         
        description:{

          required : true
        },
        title:{

           required : true
        },
        image:{

          // required : true
        },
      },
      messages: {

        description:{

          required: "Please enter description",

        },
        title:{

          required: "Please enter title",

        },
      },  

      submitHandler: function(form) { 

        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        
        med('add', btnId);

        var params = $(form).serializeArray();

        var files = $("#image")[0].files[0];

        var formData = new FormData();

        formData.append('image', document.getElementById("image").files[0]);

        $.each(params,function (key, input) {

          formData.append(input.name, input.value);
        
        });

        $.ajax({
       
          url      : APP_URL + 'add-update-image',
          type     : 'POST', 
          data     : formData,
          headers  : headers,
          cache: false,
          contentType: false,
          processData: false,
          success: function(res) {

            ajax_success(res, APP_URL + 'banner-images', btnId, btnText);
          },
          error: function(error){
          
            ajax_error(error, btnId, btnText);              
          }
        });
      } 
    });

  });

  $(".fancybox").fancybox();

  </script>


@endsection

    
               
             


                                
          
  

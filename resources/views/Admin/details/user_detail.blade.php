@extends('Admin.layout.master')

@section('css')
  
  {!! Html::style('public/custom/plugnis/fancybox/source/jquery.fancybox.css') !!}
  
@endsection

@section('content')

<div class="app-content content">
  <div class="content-wrapper ">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12">
        <h3 class="content-header-title"><i class="la la-user"></i> {{ $title }}</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item"><a href="{{ $app_url.'users' }}">users</a>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">{{ $title }} <span class="pull-right"><a href="{{$app_url.'users/'.@$user_data->id.'/edit'}}" class="btn-sm btn-info">
                <i class="ft-edit"></i>Edit user 
                </a>
                </span></h4>
                <hr>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              </div>
              <div class="card-content collapse show">
                <div class="card-content collapse show col-sm-12">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="row px-2">
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Name :</p>
                            </div>
                            <div class="col-sm-5">
                              <p class="mb-1">{{ ucwords(@$user_data->name)  }}</p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Email :</p>
                            </div>
                            <div class="col-sm-5">
                              <p class="mb-1">{{ @$user_data->email }}</p>
                              <p class="mb-1">
                            </div>
                          </div>
                        </div>
                         <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Mobile No.:</p>
                            </div>
                             <div class="col-sm-5">
                              <p class="mb-1">{{ @$user_data->country_code.'-'.@$user_data->mobile_number }}</p>
                              
                            </div>
                            </div>
                          </div>
                            <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Address.:</p>
                            </div>
                             <div class="col-sm-5">
                              <p class="mb-1">{{ @$user_data->address }}</p>
                              
                            </div>
                            </div>
                          </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Status :</p>
                            </div>
                            <div class="col-sm-5">               
                              @if(@$user_data->status == 1) 
                                <span class="badge bg-teal" title="Active">Active</span>
                              @else   
                                <span class="badge bg-warning" title="Inactive">Inactive</span>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Created At :</p>
                            </div>
                            <div class="col-sm-7">
                              <p class="mb-1">
                               {{ @$user_data->created_at }}
                              </p>
                            </div>
                          </div>
                        </div>
                         <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Mobile Verification :</p>
                            </div>
                            <div class="col-sm-5">               
                              @if(@$user_data-> is_mobile_verified == 0) 
                                <span class="badge bg-danger" title="Active">Not Verified</span>
                              @else   
                                <span class="badge bg-info" title="Inactive">Verified</span>
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Email Verification :</p>
                            </div>
                             <div class="col-sm-5">               
                              @if(@$user_data->   is_email_verified == 0) 
                                <span class="badge bg-danger" title="Active">Not Verified</span>
                              @else   
                                <span class="badge bg-info" title="Inactive">Verified</span>
                              @endif
                            </div>
                          </div>
                        </div>
                       
                      </div>       
                       <div class="row px-2" >

                        <div class="col-sm-6">
                         
                        </div>
                        </div>
                    
                       </div>
                    <!--    <div class="col-sm-2">
                             @if(@$user_data['image'] !="" && file_exists(Config::get('constants.CATEGORY_THUMBNAIL').@$user_data->image))

                                <a class="fancybox" href="{{url(Config::get('constants.CATEGORY_THUMBNAIL').$user_data->image )}}" >
                                {!! Html::image(Config::get('constants.CATEGORY_THUMBNAIL').$user_data->image,'',['alt' => 'Images','class' => '',"style" => 'width:150px;height:150px;'])!!} </a><br/><br/>

                              @else

                                @if(!empty(@$user_data->id))

                                  {!! Html::image('public/uploads/no-image.png', '', ['class' => '',"style" => 'width:70px;height:70px;']) !!}
                              
                                @endif
                              
                              @endif
                       </div> -->
                  </div>

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
  $(".fancybox").fancybox();
</script>

@endsection


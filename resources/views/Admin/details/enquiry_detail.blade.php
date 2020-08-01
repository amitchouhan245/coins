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
              <li class="breadcrumb-item"><a href="{{ $app_url.'enquiries' }}">enquiries</a>
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
                <h4 class="card-title" id="basic-layout-form">{{ $title }} <span class="pull-right"><a href="{{$app_url.'enquiries/'.@$enquiry_data->id.'/edit'}}" class="btn-sm btn-info">
                <i class="ft-edit"></i>Edit Enquiry 
                </a>
                </span></h4>
                <hr>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              </div>
              <div class="card-content collapse show" id="reload_span">
                <div class="card-content collapse show col-sm-12">
                  <div class="row">
                    <div class="col-sm-10">
                      <div class="row px-2">
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">User Name :</p>
                            </div>
                            <div class="col-sm-5">
                              <p class="mb-1">{{ ucwords(@$enquiry_data->user->name)  }}</p>
                              
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Mobile Number :</p>
                            </div>
                            <div class="col-sm-5">
                              <p class="mb-1 ">{{ @$enquiry_data->user->mobile }}</p>
                              <p class="mb-1">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Status :</p>
                            </div>
                            <div class="col-sm-5">               
                              @if(@$enquiry_data->status == 1) 
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
                               {{ @$enquiry_data->created_at }}
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-10">
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="heading-card mb-1">Enquiry Description:</p>
                            </div>
                            <div class="col-sm-9">
                              <p class="mb-1">

                                @if(!empty(@$enquiry_data->description))
                               
                                {{ ucfirst(@$enquiry_data->description) }}

                                @else
                                --
                                @endif
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-5">
                              <p class="heading-card mb-1">Category:</p>
                            </div>
                            <div class="col-sm-5">
                              <p class="mb-1">

                                @if(!empty(@$enquiry_data->category))
                                  <span class="badge bg-info" title="">
                                {{ ucfirst(@$enquiry_data->category->title) }}
                              </span>
                                @else
                                --
                                @endif
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>       
                       <div class="row px-2">
                        <div class="col-sm-6">
                         
                        </div>
                        </div>
                    
                       </div>
                     <!--   <div class="col-sm-2">
                             @if(@$enquiry_data['image'] !="" && file_exists(Config::get('constants.CATEGORY_THUMBNAIL').@$enquiry_data->image))

                                <a class="fancybox" href="{{url(Config::get('constants.CATEGORY_THUMBNAIL').$category->image )}}" >
                                {!! Html::image(Config::get('constants.CATEGORY_THUMBNAIL').$category->image,'',['alt' => 'Images','class' => '',"style" => 'width:100px;height:100px;'])!!} </a><br/><br/>

                              @else

                                @if(!empty(@$enquiry_data->id))

                                  {!! Html::image('public/uploads/no-image.png', '', ['class' => '',"style" => 'width:70px;height:70px;']) !!}
                              
                                @endif
                              
                              @endif
                       </div> -->
                  </div>

                  @if((@$enquiry_data->enquiry_documents))

                <div class="card-header">

                  <h4 class="card-title" id="basic-layout-form" ><i class="la la-hand-o-right info"></i> Enquiry Documents <span class="pull-right">
                  </span></h4>

                  <hr>

                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              </div>

              @php
              $count  = 1;
              @endphp

              @foreach($enquiry_data->enquiry_documents as $inst)
     
                @if(@$inst['category_document']['category_id'] == $enquiry_data['category_id'] )

                  <div class="col-sm-12">
                    <div class="row">        
                      <div class="col-sm-6">
                        <div class="row">
                          <div class="col-sm-4">
                              <p class="heading-card mb-1">Enquiry Document :</p>
                            </div>
                            <div class="col-sm-8">
                              <p class="mb-1">
                               {{ ucfirst(@$inst['category_document']['document_name']) }}
                             
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-4">
                              <p class="heading-card mb-1">Document :</p>
                            </div>
                            <div class="col-sm-8">   

                           
                             @if(@$inst['document_image'] !="" && file_exists(Config::get('constants.ENQUIRY_DOCUMENT_THUMBNAIL').@$inst['document_image']))

                                <a class="fancybox" href="{{url(Config::get('constants.ENQUIRY_DOCUMENT_THUMBNAIL').$inst['document_image'] )}}" >
                                {!! Html::image(Config::get('constants.ENQUIRY_DOCUMENT_THUMBNAIL').$inst['document_image'] ,'',['alt' => 'Images','class' => '',"style" => 'width:100px;height:100px;'])!!} </a><br/><br/>

                              @else

                                @if(!empty(@$inst['id']))

                                  {!! Html::image('public/uploads/no-image.png', '', ['class' => '',"style" => 'width:70px;height:70px;']) !!}
                              
                                @endif
                              
                              @endif
                     
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                  @endforeach

                @endif

              @if(@$enquiry_data->documents)
                
                  <div class="card-header">
                <h4 class="card-title" id="basic-layout-form" ><i class="la la-hand-o-right info"></i> Documents <span class="pull-right">
                </span></h4>

                <hr>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              </div>

                @php
                $count  = 1;
                @endphp

                  @foreach($category->documents as $doc)
                         
                           <div class="col-sm-12">
                          <div class="row">

                               <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-4">
                              <p class="heading-card mb-1">Document :</p>
                            </div>
                            <div class="col-sm-8">
                              <p class="mb-1">
                               {{ ucfirst(@$doc['document_name']) }}
                              </p>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-4">
                              <p class="heading-card mb-1">Status :</p>
                            </div>
                            <div class="col-sm-4" >               
                              @if(@$doc['status'] == 1) 
                                <span class="badge bg-teal" title="Active">Active</span>
                              @else   
                                <span class="badge bg-warning" title="Inactive">Inactive</span>
                              @endif
                            </div>
                             <div class="col-sm-4">
                              @if(@$doc['status'] == 1)
  
                                <button class="btn btn-sm btn-info" href="javascript:void(0)" title="Make Inactive Category" onclick="update_status(0,'CategoryDocument', '{{ $doc['id'] }}');relaodPage();">Make Inactive
                                </button>

                              @else 

                                <button class="btn btn-sm btn-info" href="javascript:void(0)" title="Make Active Category" onclick="update_status(1,'CategoryDocument', '{{ $doc['id'] }}');relaodPage();"></i> Make Active</button>

                              @endif  
                            </div>
                          </div>
                        </div>
                           
                          </div>
                        </div>
                    @endforeach

                @endif

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

  function relaodPage() {

    setTimeout(function(){ location.reload(); }, 1000);
  }
</script>

@endsection


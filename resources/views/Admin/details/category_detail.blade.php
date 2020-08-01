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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">{{ $title }} <span class="pull-right"><a href="{{$app_url.'categories/'.@$category->id.'/edit'}}" class="btn-sm btn-info"><i class="ft-edit"></i>Edit service</a></span></h4>
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
                                                            <p class="heading-card mb-1">Title :</p>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <p class="mb-1">{{ ucwords(@$category->title) }}</p>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="heading-card mb-1">Charge :</p>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <p class="mb-1 badge bg-danger">₹ {{ @$category->charge }}</p>
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
                                                            @if(@$category->status == 1)
                                                            <span class="badge bg-teal" title="Active">Active</span> @else
                                                            <span class="badge bg-warning" title="Inactive">Inactive</span> @endif
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
                                                                {{ @$category->created_at }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="heading-card mb-1">Description:</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <p class="mb-1">
                                                                @if(!empty(@$category->description)) {{ ucfirst(@$category->description) }} @else -- @endif
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
                                        <div class="col-sm-2">
                                            @if(@$category['image'] !="" && file_exists(Config::get('constants.CATEGORY_THUMBNAIL').@$category->image))

                                            <a class="fancybox" href="{{url(Config::get('constants.CATEGORY_THUMBNAIL').$category->image )}}">
                                            {!! Html::image(Config::get('constants.CATEGORY_THUMBNAIL').$category->image,'',['alt' => 'Images','class' => '',"style" => 'width:100px;height:100px;'])!!} </a>
                                            <br/>
                                            <br/> @else @if(!empty(@$category->id)) {!! Html::image('public/uploads/no-image.png', '', ['class' => '',"style" => 'width:70px;height:70px;']) !!} @endif @endif
                                        </div>
                                    </div>

                                    @if(count($category->instructions) > 0)
                                    <!--   <h3 align="center" style="color: #416ec5d1;"><b>Instructions</b></h3> -->
                                    <div class="card-header">
                                        <h4 class="card-title" id="basic-layout-form"><i class="la la-hand-o-right info"></i> Instructions <span class="pull-right"></span></h4>
                                        <hr>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    </div>
                                    @php $count = 1; @endphp @foreach($category->instructions as $inst)

                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="heading-card mb-1">Instruction :</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="mb-1">
                                                            {{ ucfirst(@$inst['title']) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="heading-card mb-1">Status :</p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        @if(@$inst['status'] == 1)
                                                        <span class="badge bg-teal" title="Active">Active</span> @else
                                                        <span class="badge bg-warning" title="Inactive">Inactive</span> @endif
                                                    </div>
                                                    <div class="col-sm-4">
                                                        @if(@$inst['status'] == 1)

                                                        <button class="btn btn-sm btn-info" href="javascript:void(0)" title="Make Inactive Category" onclick="update_status(0,'Instruction', '{{ $inst['id'] }}');relaodPage('no');">Make Inactive
                                                        </button>

                                                        @else

                                                        <button class="btn btn-sm btn-info" href="javascript:void(0)" title="Make Active Category" onclick="update_status(1,'Instruction', '{{ $inst['id'] }}');relaodPage('no');">
                                                            </i> Make Active</button>

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach @endif @if(count($category->documents) > 0)

                                    <div class="card-header">
                                        <h4 class="card-title" id="basic-layout-form"><i class="la la-hand-o-right info"></i> Documents <span class="pull-right"></span></h4>

                                        <hr>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    </div>

                                    @php $count = 1; 
                                    
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
                                                    <div class="col-sm-4">
                                                        @if(@$doc['status'] == 1)
                                                        <span class="badge bg-teal" title="Active">Active</span> @else
                                                        <span class="badge bg-warning" title="Inactive">Inactive</span> @endif
                                                    </div>
                                                    <div class="col-sm-4">
                                                        @if(@$doc['status'] == 1)

                                                        <button class="btn btn-sm btn-info" href="javascript:void(0)" title="Make Inactive Category" onclick="update_status(0,'CategoryDocument', '{{ $doc['id'] }}');relaodPage('no');">Make Inactive
                                                        </button>

                                                        @else
                                                        <button class="btn btn-sm btn-info" href="javascript:void(0)" title="Make Active Category" onclick="update_status(1,'CategoryDocument', '{{ $doc['id'] }}');relaodPage('no');">
                                                            Make Active</button>

                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach  @endif

                                    @if(count($category->category_attachments) > 0)

                                    <div class="card-header">
                                      <h4 class="card-title" id="basic-layout-form"><i class="la la-hand-o-right info"></i> Attachments <span class="pull-right"><a class="btn btn-sm btn-danger" href="{{$app_url.'category-attached-docs/'.@$category->id}}" title="Add Attachments" ><i class="ft-plus-square"></i> Add Attach </a> </span></h4><hr>
                                      <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    </div>

                                     @foreach($category->category_attachments as $att)

                                      <div class="col-sm-12">
                                        <div class="row">

                                            <div class="col-sm-4">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="heading-card mb-1">Attachment :</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p class="mb-1">
                                                            {{ ucfirst(@$att['title']) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                             <div class="col-sm-2">
                                            @if(@$att['image'] !="" && file_exists(Config::get('constants.ATTACHED_DOCUMENT_THUMBNAIL').@$att->image))

                                            <a class="fancybox" href="{{url(Config::get('constants.ATTACHED_DOCUMENT_THUMBNAIL').$att->image )}}">
                                            {!! Html::image(Config::get('constants.ATTACHED_DOCUMENT_THUMBNAIL').$att->image,'',['alt' => 'Images','class' => '',"style" => 'width:80px;height:80px;'])!!} </a>
                                            <br/>
                                            <br/> @else @if(!empty(@$att->id)) {!! Html::image('public/uploads/no-image.png', '', ['class' => '',"style" => 'width:70px;height:70px;']) !!} @endif @endif
                                        </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p class="heading-card mb-1">Status :</p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        @if(@$att['status'] == 1)
                                                        <span class="badge bg-teal" title="Active">Active</span> @else
                                                        <span class="badge bg-warning" title="Inactive">Inactive</span> @endif
                                                    </div>
                                                    <div class="col-sm-4">
                                                        @if(@$att['status'] == 1)

                                                        <button class="btn btn-sm btn-info" href="javascript:void(0)" title="Make Inactive Category" onclick="update_status(0,'CategoryAttachDocs', '{{ $att['id'] }}');relaodPage('no');">Make Inactive
                                                        </button>

                                                        @else
                                                        <button class="btn btn-sm btn-info" href="javascript:void(0)" title="Make Active Category" onclick="update_status(1,'CategoryAttachDocs', '{{ $att['id'] }}');relaodPage('no');">
                                                            Make Active</button>

                                                        @endif
                                                         <p>
                                                           
                                                         </p>
                                                         <button class="btn btn-sm btn-danger" href="javascript:void(0)" title="Make Inactive Category" 
                                                         onclick="delete_record('CategoryAttachDocs', '{{ $att->id }}');relaodPage('yes');">Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    @endif
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection @section('script') {!! Html::script('public/custom/plugnis/fancybox/source/jquery.fancybox.js') !!}

<script type="text/javascript">

  $(".fancybox").fancybox();

  function relaodPage(id) {

    if (id == 'yes') {
  
      setTimeout(function() {
  
        location.reload();
  
      }, 3000);
  
    }else{
  
      setTimeout(function() {
  
        location.reload();
  
      }, 1000);
    }     
  }

</script>

@endsection
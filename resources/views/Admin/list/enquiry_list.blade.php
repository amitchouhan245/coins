@extends('Admin.layout.master')

@section('css')

  {!! Html::style('public/custom/plugnis/fancybox/source/jquery.fancybox.css') !!}

@endsection

@section('content')

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12">
          <h3 class="content-header-title"><i class="la la-legal"></i> {{ $title }}</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="#">{{ $title }}</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">
             <a href="{{ $app_url.'enquiries/create' }}" class="btn btn-info btn-min-width btn-glow mr-1 mb-1">
              Add New Enquiry
             </a>
          </div>
        </div>
      </div>
      <div class="content-body">

        <!-- Start Your Page Here -->

        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">All Enquiries</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered" id="table">
                      <thead>
                        <tr>

                          <th>#</th>
                          <th>Name</th>
                          <th>Mobile No.</th>
                          <th>Description</th>
                          <th>Status</th>
                          <th>Actions</th>
                          <th>
                          <div class="LTcheckbox">
                          <input class="checked_all" type="checkbox"><span class="checkbox_lt"></span>
                          </div>
                          <a class="" href="#" title="Selected record permanently deleted" onclick="bulk_delete_record('Enquiry')"><i class="la la-trash"></i></a>
                          </th>
                          
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        <!-- End Page Here -->

      </div>
    </div>
  </div>

@endsection

@section('script')

{!! Html::script('public/custom/plugnis/fancybox/source/jquery.fancybox.js') !!}


  <script>

    $(function() { 
 
      $('#table').DataTable({
        "columnDefs": [ {
          "targets": 'removeSortingClass',
          "orderable": false,
        }],
        "aaSorting" : [],
        processing: true,
        serverSide: true,
        ajax: APP_URL + 'enquiries',
        columns: [

          {data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center" },
          { data: 'user.name', name: 'user.name', className: "first_letter text-center" },
          { data: 'user.mobile_number', name: 'user.mobile_number', className: "first_letter text-center" },
          { data: 'description', name: 'description', className: "text-center" },
          { data: 'status', name: 'status', className: "text-center"},           
          { data: 'action', name: 'Actions', orderable: false, searchable: false,className: "text-center"}  ,
           { data: 'bulk_delete', name: 'all delete', orderable: false, searchable: false}                         
        ]
      });
    
    });

</script>
   
   <script type="text/javascript">

    $("#table").on('draw.dt',function(){

      $(".fancybox").fancybox();

   });

  </script>
  
@endsection
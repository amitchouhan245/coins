@extends('Admin.layout.master')

@section('content')

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12">
          <h3 class="content-header-title"><i class="la la-gear"></i> {{ $title }}</h3>
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
             <a href="{{ $app_url.'contents/create' }}" class="btn btn-info btn-min-width btn-glow mr-1 mb-1">
              Add New Content
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
                  <h4 class="card-title">All Contents</h4>
                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered" id="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Type</th>
                          <th>English</th>
                          <th>Arabic</th>
                          <th>Status</th>
                          <th>Actions</th>
                          
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
        ajax: APP_URL + 'contents',
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center" },
          { data: 'title', name: 'title', className: "first_letter text-center" },
          { data: 'type', name: 'type', className: "text-center" },
          { data: 'eng_content', name: 'eng_content', className: "first_letter text-center" },
          { data: 'arb_content', name: 'arb_content', className: "first_letter text-center" },
          { data: 'status', name: 'status', className: "text-center"},           
          { data: 'action', name: 'Actions', orderable: false, searchable: false,className: "text-center"}                      
        ]
      });
    
    });

</script>
 
@endsection
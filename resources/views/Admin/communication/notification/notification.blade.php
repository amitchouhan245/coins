@extends('Admin.layout.master')

@section('css')

  {!! Html::style('public/custom/plugnis/fancybox/source/jquery.fancybox.css') !!}

@endsection

@section('content')
 
 <div class="app-content content">
   <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title"><i class="icon-bell"></i> {{ $title }}</h3>
            <div class="row breadcrumbs-top">
             <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{$app_url.'dashboard'}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">{{ $title }}</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-6 col-12">
          <div class="btn-group">
            <a href="{{$app_url.'send-notification'}}" class="btn btn-info btn-min-width btn-glow mr-1 mb-1">
              Send Notification
             </a>         
          </div>
        </div>
      </div>
      <div class="content-body">
         <div class="row">
            <div class="col-12">
               <div class="card">                  
                  <div class="card-header">
                     <h4 class="card-title">{{ $title }}</h4>
                     <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>               
                  </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <table class="table table-striped table-bordered" id="table">
                      <thead>
                        <tr>                                                   
                          <th>#</th> 
                          <th>Img/Ride Id</th>  
                          <th>User Name</th>                                   
                          <th>Title</th>                                     
                          <th>Message</th>
                                           
                          <th>Date and Time</th>
                          <th>Read Status</th>
                          <th>Actions</th>
                          <th>
                           <div class="LTcheckbox">
                          <input class="checked_all" type="checkbox"><span class="checkbox_lt"></span>
                          </div>
                          <a  class="" href="#" title="Select record permanently Deleted" onclick="bulk_delete_record('Notification')"><i class="la la-trash"></i></a>
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
        "columnDefs": [{
          "targets": 'removeSortingClass',
          "orderable": false,
        }],
        "aaSorting" : [],
        processing: true,
        serverSide: true,
        ajax: "{{ $app_url.'notifications' }}",
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center" },
         
           { data: 'image', name: 'image', className: "text-center" },
          { data: 'UserName', name: 'UserName', className: "first_letter text-center" },
          { data: 'title', name: 'title', className: "first_letter text-center" },
          { data: 'message', name: 'message', className: "first_letter text-center" },

          { data: 'created_at', name: 'created_at', className: "text-center"},           
          { data: 'status', name: 'status', className: "text-center"},           
          { data: 'action', name: 'Actions', orderable: false, searchable: false,className: "text-center"},
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
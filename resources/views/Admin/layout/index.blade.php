@extends('Admin.layout.master')

@section('css')

@endsection

@section('content')

<div class="app-content content">
  <div class="content-wrapper" >
    <section class="content container-fluid"> 
      <div class="content-body">
        <div class="row">
           <div class="col-xl-4 col-lg-6 col-12">
           <a href="{{ url('admin/users') }}"> 
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="info">{{ @$users }}</h3>
                      <h6>Users </h6>
                    </div>
                    <div>
                      <i class="la la-users info font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%"
                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
           </a>
          </div>

          <div class="col-xl-4 col-lg-6 col-12">
              <a href="{{ url('admin/dashboard') }}"> 
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="warning">123</h3>
                      <h6>Services</h6>
                    </div>
                    <div>
                      <i class="la la-folder-open warning font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"
                    aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div>
          <div class="col-xl-4 col-lg-6 col-12">
           <a href="{{ url('admin/dashboard') }}"> 
            <div class="card pull-up">
              <div class="card-content">
                <div class="card-body">
                  <div class="media d-flex">
                    <div class="media-body text-left">
                      <h3 class="success">123</h3>
                      <h6>App Count</h6>
                    </div>
                    <div>
                      <i class="la la-legal success font-large-2 float-right"></i>
                    </div>
                  </div>
                  <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                    <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </a>
          </div>
        </div>
       <!--   <div class="row">
           <div id="recent-transactions" class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><code>Enquiry Bar Chart</code></h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                  <div class="card-content collapse show">
                  <div class="card-body">
                    <div id="bar-chart" class="height-200"></div>
                  </div>
                </div>
                </div>
              </div>
        </div> -->
      </div>
    </section>
  </div>
</div> 

@endsection

@section('script')


  {!! Html::script('public/AdminTheme/app-assets/vendors/js/charts/raphael-min.js') !!}

  {!! Html::script('public/AdminTheme/app-assets/vendors/js/charts/morris.min.js') !!}

<script type="text/javascript">

  function get_enquiry_count() {

  $.ajax({

    url : APP_URL + "enquiry-detail-dashboard",
    type : 'GET',
    data:{
    }, 
    dataType : "JSON",
    headers: headers,

    success : function (res){
      
      var dasta = [];

      if(res.result.length > 0){

        $('#bar-chart').show();
        $('#bar-chart').html(null);

        for (var i = 0; i < res.result.length; i++) {

          dasta.push({
              
            y:res.result[i].months,
            a:res.result[i].enquiries,

          });
        } 
        Morris.Bar({

          element: 'bar-chart',
          data: dasta,
          xkey: 'y',
          ykeys: ['a'],
          labels: ['No Of Enquiries'],
          barGap: 6,
          barSizeRatio: 0.35,
          smooth: true,
          gridLineColor: '#e3e3e3',
          numLines: 5,
          gridtextSize: 14,
          fillOpacity: 0.4,
          resize: true,
          barColors: ['#f00a0d','#FF7D4D']
      
        });

      }else{

        $('#bar-chart').html(null);
      
      }
    },

    error: function(error) {
       
    }
  })
}
get_enquiry_count();

</script>
 
@endsection

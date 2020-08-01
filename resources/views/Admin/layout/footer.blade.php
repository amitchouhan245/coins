  <footer class="footer footer-static footer-light navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">Copyright &copy; 2019 <a class="text-bold-800 grey darken-2" href="javascript:void(0)"
        >

     {{ Config::get('constants.PROJECT_TITLE') }}

         </a>, All rights reserved. </span>
      <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Hand-crafted & Made with <i class="ft-heart pink"></i></span>
    </p>
  </footer>

  <!-- BEGIN VENDOR JS--> 
  {!! Html::script('public/AdminTheme/app-assets/vendors/js/ui/jquery.sticky.js') !!}
  {!! Html::script('public/AdminTheme/app-assets/vendors/js/charts/jquery.sparkline.min.js') !!}
  {!! Html::script('public/AdminTheme/app-assets/data/jvector/visitor-data.js') !!}
  
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  {!! Html::script('public/AdminTheme/app-assets/js/core/app-menu.js') !!}
  {!! Html::script('public/AdminTheme/app-assets/js/core/app.js') !!}
  {!! Html::script('public/AdminTheme/app-assets/js/scripts/customizer.js') !!}
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  {!! Html::script('public/AdminTheme/app-assets/vendors/js/forms/icheck/icheck.min.js') !!}
  {!! Html::script('public/AdminTheme/app-assets/js/scripts/ui/breadcrumbs-with-stats.js') !!}

  {!! Html::script('public/AdminTheme/app-assets/vendors/js/extensions/sweetalert.min.js') !!}
  {!! Html::script('public/AdminTheme/app-assets/js/scripts/extensions/sweet-alerts.js') !!}
  {!! Html::script('public/AdminTheme/app-assets/vendors/js/tables/datatable/datatables.min.js') !!}
  {!! Html::script('public/AdminTheme/app-assets/js/scripts/tables/datatables/datatable-basic.js') !!}
  {!! Html::script('public/AdminTheme/app-assets/js/core/libraries/jquery.validate.min.js')!!}
  
  {!! Html::script('public/AdminTheme/app-assets/js/scripts/forms/checkbox-radio.js')!!}
  {!! Html::script('public/AdminTheme/assets/js/scripts.js')!!}
  

  {!! Html::script('public/AdminTheme/app-assets/vendors/js/forms/select/select2.full.min.js') !!}

  {!! Html::script('public/AdminTheme/app-assets/js/scripts/forms/select/form-select2.js') !!}
 
  @yield('script')
  

  <script type="text/javascript">
    
   $( function() {

    $("#global_search" ).keyup(function() {

      $.ajax({

        url: SITEURL + 'admin/search',
        type: 'GET',
        headers  : headers,
        data: { 'term': $("#global_search").val() },
        success: function(res){
                  
            var passenger = '';
            var driver = '';        
            var searchDriver = '';
            var searchPassnger ='';
            var result = '';

          for (var i = 0; i < res.length; i++) {
                     
            if(res[i].user_type == 2 ){

              if(res[i].img != ''){

               passenger = passenger +'<a href="'+res[i].label+'" class="list-group-item" style="text-decoration: none;">'+'{!!Html::image(Config::get("constants.PROFILE_IMAGE")."'+res[i].img+'","",["class" => "img-circle"]) !!}'+res[i].value +'</a>'
              ;
             }else{

               passenger = passenger +'<a href="'+res[i].label+'" class="list-group-item" style="text-decoration: none;">'+'{!!Html::image(Config::get("constants.NO_IMAGE")."no-image.png","",["class" => "img-circle"]) !!}'+res[i].value +'</a>'
              ;
             }
            }
            if(res[i].user_type == 3 ){

              if(res[i].img != ''){

                driver = driver +'<a href="'+res[i].label+'" class="list-group-item" style="text-decoration: none;">'+'{!!Html::image(Config::get("constants.PROFILE_IMAGE")."'+res[i].img+'","",["class" => "img-circle"]) !!}'+res[i].value +'</a>'
              ;

              }else{

                driver = driver +'<a href="'+res[i].label+'" class="list-group-item" style="text-decoration: none;">'+'{!!Html::image(Config::get("constants.NO_IMAGE")."no-image.png","",["class" => "img-circle"]) !!}'+res[i].value +'</a>'
              ;
              }
            }
          }

          if(passenger){
           
          searchPassnger ='<div class="panel-heading">'+
                                      '<h5 class="panel-title"><i>Passenger</i></h5></div>'+
                                      '<ul class="list-group">'+passenger+'</ul>';
          }
          if (driver) {

          searchDriver = '<div class="panel-heading">'+
                                      '<h5 class="panel-title">Driver</h5></div>'+
                                      '<ul class="list-group">'+driver+'</ul>';
          }

         result =searchPassnger + searchDriver ;

          $("#global_search_elements").html(result);
        }
      });
    });   
  });

  var con = $("#global_search_elements");

  var container = $("#searchInput");

  $(container).mouseenter(function(){

    con.show();

  });

  $(container).mouseleave(function(){

    con.hide();

  });
  
  </script>

  </body>
</html>
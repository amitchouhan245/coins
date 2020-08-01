<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="Travel">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>

     @if(isset($title) && !empty($title))

     {{ @$title }} | {{ Config::get('constants.PROJECT_TITLE') }}

     @else

     {{ Config::get('constants.PROJECT_TITLE') }}
     
     @endif

  </title>
      
  <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="../../app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <link rel="icon" href="" type="image/png" sizes="16x16">

  {!! Html::style('public/AdminTheme/app-assets/css/vendors.css')!!}
<!--   {!! Html::style('public/custom/plugnis/sweetalert/sweetalert2.min.css')!!} -->
  {!! Html::style('public/AdminTheme/app-assets/css/app.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/css/core/menu/menu-types/horizontal-menu.css') !!}
<!--   {!! Html::style('public/css/custom.css') !!} -->

  {!! Html::style('public/AdminTheme/app-assets/fonts/simple-line-icons/style.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/css/core/colors/palette-gradient.css')!!}
  {!! Html::style('public/AdminTheme/assets/css/style.css')!!}
  {!! Html::style('public/AdminTheme/app-assets/vendors/css/forms/selects/select2.min.css') !!}
  {!! Html::style('public/AdminTheme/app-assets/fonts/simple-line-icons/style.css') !!}
  {!! Html::script('public/AdminTheme/app-assets/vendors/js/vendors.min.js')!!}
  {!! Html::style('public/AdminTheme/app-assets/vendors/css/tables/datatable/datatables.min.css')!!}

    <style>      

    .img-circle {
      
      border-radius: 50% !important;
      height: 35px !important;
      width: 35px !important;

    }
    .img-circle {
     
      margin:-18px 5px -15px -10px !important;
      white-space:nowrap;
    }      


  </style>
  
@yield('css')

  <?php

    $sessionArray = Session::get(Request::segment('1')); 

    $APP_URL =  url('/') . '/'.Request::segment('1') .'/';
    
  ?>
  
  <script>

    var API_URL =  "{{ url('api') . '/'.Request::segment('1') }}/";
    var APP_URL =  "{{ url('/') . '/'.Request::segment('1') }}/";
    var SITEURL = "{{ url('/') }}/";
    
  </script>

  <script>
    
    var headers = { 

      'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
      'Authorization' : "Bearer {{ @$sessionArray['jwt_token'] }}",
      //'Accept': 'application/json',
      //'Content-Type': 'application/x-www-form-urlencoded'      
    };

  </script>

</head>

<body class="horizontal-layout horizontal-menu 2-columns  menu-expanded pace-done" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
  <div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
      <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
  </div>
  
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
   
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item">
            <a class="navbar-brand" href="#">
<!-- 
            {!! Html::image('public/AdminTheme/app-assets/images/logo/enquiry.png', 'branding logo', ["style" => 'width:200px;']) !!}
 -->
 <b>
   
              {{ Config::get('constants.PROJECT_TITLE') }}
 </b>

            
            </a>
          </li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>   
      <div class="navbar-container content">
      <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="nav navbar-nav mr-auto float-left">
          <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
       <!--    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li> -->

<!--           <li class="nav-item nav-search">
            <a class="nav-link nav-link-search" href="#"><i class="ficon ft-search"></i></a>
            <div class="search-input" id="searchInput">
              <form>
                <input class="input" type="text" placeholder="Search here...." aria-label="Search" id="global_search" name="global_search">
                <span id="global_search_elements"></span>
              </form>
            </div>
          </li> -->
        </ul>
        <ul class="nav navbar-nav float-right">
          <li class="dropdown dropdown-user nav-item">
            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
              <span class="mr-1">Hello,
                <span class="user-name text-bold-700">{{ ucwords($sessionArray['full_name']) }}</span>
              </span>
              <span class="avatar avatar-online">

                @if(@$sessionArray['profile_image'] != "" && file_exists(Config::get('constants.PROFILE_IMAGE').$sessionArray['profile_image']))
                  
                  {!! Html::image(Config::get('constants.PROFILE_IMAGE').@$sessionArray['profile_image'],'',['alt' => 'User profile picture','class' => '',"style" => ''])!!}
                
                @else
                
                  <img src="{{ url('public/AdminTheme/app-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i></span>
                  
                @endif

              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

              <a class="dropdown-item" href="{{ $app_url.'profile' }}"><i class="ft-user"></i> Edit Profile</a>
              <a class="dropdown-item" href="{{ $app_url.'change-password'}}"><i class="ft-lock"></i> Change Password</a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ $app_url.'logout'}}"><i class="ft-power"></i> Logout</a>
            </div>
          </li>
          <!-- <li class="dropdown dropdown-notification nav-item">
            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
              <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">5</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <h6 class="dropdown-header m-0">
                  <span class="grey darken-2">Notifications</span>
                </h6>
                <span class="notification-tag badge badge-default badge-danger float-right m-0">5 New</span>
              </li>
              <li class="scrollable-container media-list w-100">
                <a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading">You have new order!</h6>
                      <p class="notification-text font-small-3 text-muted">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                      <small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">30 minutes ago</time>
                      </small>
                    </div>
                  </div>
                </a>
                <a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i class="ft-download-cloud icon-bg-circle bg-red bg-darken-1"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading red darken-1">99% Server load</h6>
                      <p class="notification-text font-small-3 text-muted">Aliquam tincidunt mauris eu risus.</p>
                      <small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Five hour ago</time>
                      </small>
                    </div>
                  </div>
                </a>
                <a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading yellow darken-3">Warning notifixation</h6>
                      <p class="notification-text font-small-3 text-muted">Vestibulum auctor dapibus neque.</p>
                      <small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Today</time>
                      </small>
                    </div>
                  </div>
                </a>
                <a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i class="ft-check-circle icon-bg-circle bg-cyan"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading">Complete the task</h6>
                      <small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last week</time>
                      </small>
                    </div>
                  </div>
                </a>
                <a href="javascript:void(0)">
                  <div class="media">
                    <div class="media-left align-self-center"><i class="ft-file icon-bg-circle bg-teal"></i></div>
                    <div class="media-body">
                      <h6 class="media-heading">Generate monthly report</h6>
                      <small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Last month</time>
                      </small>
                    </div>
                  </div>
                </a>
              </li>
              <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center" href="javascript:void(0)">Read all notifications</a></li>
            </ul>
          </li> -->
          <!--  notification -->
<!--            <li class="dropdown dropdown-notification nav-item">
           
            <a class="nav-link nav-link-label" href="" ><i class="ficon ft-bell"></i>
              <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow" id="admin_notification_badge">0</span>
            </a>
          </li> -->
        </ul>
      </div>
    </div>
  </div>
</nav>
  <div id="sticky-wrapper" class="sticky-wrapper" style="height: 70px;">

    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow navbar-brand-center" role="navigation" data-menu="menu-wrapper" data-nav="brand-center" style="">

      <div class="navbar-container main-menu-content" data-menu="menu-container">

        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

          <li class="nav-item">

            <a class="dropdown-toggle nav-link" href="{{@$app_url.'dashboard'}}"><i class="la la-home"></i><span class="">Dashboard</span></a>

          </li>
          
           <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-users"></i><span>Users</span></a>

            <ul class="dropdown-menu">
              
              <li data-menu=""><a class="dropdown-item" href="{{$app_url.'users'}}" data-toggle="dropdown"><i class="icon-users"></i>Users</a>
              </li>

              <li data-menu=""><a class="dropdown-item" href="{{$app_url.'drivers'}}" data-toggle="dropdown"><i class="icon-users"></i>Drivers</a>
              </li>

            </ul>
          </li>

          <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-wrench"></i><span>Settings</span></a>

            <ul class="dropdown-menu">
             <!--  <li data-menu=""><a class="dropdown-item" href="{{$app_url.'countries'}}" data-toggle="dropdown"><i class="ft-flag"></i>Countries</a>
              </li>
              <li data-menu=""><a class="dropdown-item" href="{{$app_url.'states'}}" data-toggle="dropdown"><i class="la la-flag-o"></i>States</a>
              <li data-menu=""><a class="dropdown-item" href="{{$app_url.'cities'}}" data-toggle="dropdown"><i class="la la-flag-checkered"></i>Cities</a>
              </li>  -->
             
               <li data-menu=""><a class="dropdown-item" href="{{$app_url.'contents'}}" data-toggle="dropdown"><i class="la la-edit"></i>Content Management</a>
              </li>

              <li data-menu=""><a class="dropdown-item" href="{{$app_url.'app-info'}}" data-toggle="dropdown"><i class="la la-share-alt"></i>App Info</a>
              </li>

            </ul>
          </li>

          
           <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="ft-tv"></i><span>Web Front</span></a>
            <ul class="dropdown-menu">
              
             <!--  <li data-menu=""><a class="dropdown-item" href="{{$app_url.'support-list'}}" data-toggle="dropdown"><i class="ft-message-square"></i>Support</a>
              </li> -->

              <li data-menu=""><a class="dropdown-item" href="{{$app_url.'banner-images'}}" data-toggle="dropdown"><i class="ft-image"></i>Banner Image</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>

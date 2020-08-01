@include('Admin.layout.header')

@if(Request::segment('1') === 'admin')
		 
	@include('Admin.layout.nav-bar')

@elseif(Request::segment('1') === 'societyadmin')
	
	@include('Admin.layout.society-admin-nav-bar')
		
@endif

@yield('content')

@include('Admin.layout.footer')
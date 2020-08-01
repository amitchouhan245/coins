	@if($data->deleted_at != null)

	 <button type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="false" onclick="restore('User', '{{ $data->id }}')" title="Click here to Restore">Restore</button>

	@else

		<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
			
		<div class="dropdown-menu">
	
		@if($data->status == 1)
	
	  		<a class="dropdown-item" href="javascript:void(0)" title="Make Inactive User" onclick="update_status(0,'User', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Inactive
	  		</a>
		
		@else	
			<a class="dropdown-item" href="javascript:void(0)" title="Make Active User" onclick="update_status(1,'User', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
			
		@endif	

	  	<a class="dropdown-item" href="{{ $app_url.'users/'.$data->id.'/edit' }}" title="Edit User"><i class="la la-edit"></i> Edit User</a>

	  	<!-- <a class="dropdown-item"  href="{{$app_url.'users/'.$data->id}}" title="User Details"><i class="la la-edit"></i> Details </a> 
 		  	 -->
	  	<a class="dropdown-item" onclick="delete_record('User', '{{ $data->id }}')" href="#" title="Delete User" ><i class="la la-trash"></i> Delete </a>   
</div>

	@endif  	                         

<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
<div class="dropdown-menu">
	
	@if($data->deleted_at != null)
	 
		<a class="dropdown-item" href="javascript:void(0)" title="Click here to Restore" >Restore Content</a>
	
	@else

		@if($data->status == 1)
	
	  		<a class="dropdown-item" href="javascript:void(0)" title="Make Inactive Content" onclick="update_status(0,'Content', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Inactive
	  		</a>
		
		@else	
			<a class="dropdown-item" href="javascript:void(0)" title="Make Active Content" onclick="update_status(1,'Content', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
			
		@endif	

	  	<a class="dropdown-item" href="{{ $app_url.'contents/'.$data->id.'/edit' }}" title="Edit Content"><i class="la la-edit"></i> Edit Content</a>

	  	<!-- <a class="dropdown-item"  href="" title="State Details"><i class="la la-info"></i> State Details</a> -->
 		  	
	  	<a class="dropdown-item" onclick="delete_record('Content', '{{ $data->id }}')" href="#" title="Delete Content" ><i class="la la-trash"></i> Delete </a>    

	@endif  	                         
	
</div>


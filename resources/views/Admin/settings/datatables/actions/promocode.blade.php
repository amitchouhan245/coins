<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
<div class="dropdown-menu">
	
	@if($data->deleted_at != null)
	 
		<a class="dropdown-item" href="javascript:void(0)" title="Click here to Restore" >Restore Promocode</a>
	
	@else

		@if($data->status == 1)
	
	  		<a class="dropdown-item" href="javascript:void(0)" title="Make Inactive Promocode" onclick="update_status(0,'Promocode', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Inactive
	  		</a>
		
		@else	
			<a class="dropdown-item" href="javascript:void(0)" title="Make Active Promocode" onclick="update_status(1,'Promocode', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
			
		@endif	

	  	<a class="dropdown-item" href="{{ $app_url.'promocodes/'.$data->id.'/edit' }}" title="Edit Promocode"><i class="la la-edit"></i> Edit Promocode</a>

	  	<!-- <a class="dropdown-item"  href="" title="State Details"><i class="la la-info"></i> State Details</a> -->
 		  	
	  	<a class="dropdown-item" onclick="delete_record('Promocodes', '{{ $data->id }}')" href="#" title="Delete Promocode" ><i class="la la-trash"></i> Delete </a>    

	@endif  	                         
	
</div>


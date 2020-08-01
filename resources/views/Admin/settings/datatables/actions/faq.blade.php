<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
	
	<div class="dropdown-menu">
	
		@if($data->status == 1)
	
	  		<a class="dropdown-item" href="javascript:void(0)" title="Make Inactive faq" onclick="update_status(0,'Faq', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Inactive
	  		</a>
		
		@else	
			<a class="dropdown-item" href="javascript:void(0)" title="Make Active faq" onclick="update_status(1,'Faq', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
			
		@endif	

	  	<a class="dropdown-item" href="{{ $app_url.'faqs/'.$data->id.'/edit' }}" title="Edit faq"><i class="la la-edit"></i> Edit FAQ</a>
 		  	
	  	<a class="dropdown-item" onclick="delete_record('Faq', '{{ $data->id }}')" href="#" title="Delete faq" ><i class="la la-trash"></i> Delete </a>    

</div>


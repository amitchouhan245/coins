	@if($data->deleted_at != null)

	 <button type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="false" onclick="restore('Category', '{{ $data->id }}')" title="Click here to Restore">Restore</button>

	@else

		<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
			
		<div class="dropdown-menu">
	
			@if($data->status == 1)
		
				<a class="dropdown-item" href="javascript:void(0)" title="Make Inactive Category Service" onclick="update_status(0,'Category', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Inactive
				</a>
			
			@else	
				<a class="dropdown-item" href="javascript:void(0)" title="Make Active Category Service" onclick="update_status(1,'Category', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
				
			@endif	

			<a class="dropdown-item" href="{{ $app_url.'categories/'.$data->id.'/edit' }}" title="Edit Category Service"><i class="la la-edit"></i> Edit Category Service</a>

			<a class="dropdown-item"  href="{{$app_url.'categories/'.$data->id}}" title="Category Service Detail"><i class="la la-edit"></i> Details </a> 
			
			<a class="dropdown-item"  href="{{$app_url.'category-attached-docs/'.$data->id}}" title="Add Attached"><i class="la la-plus"></i> Add Attachment </a>
				
			<a class="dropdown-item" onclick="delete_record('Category', '{{ $data->id }}')" href="#" title="Delete Category Service" ><i class="la la-trash"></i> Delete </a>   

	</div>

	@endif  	                         

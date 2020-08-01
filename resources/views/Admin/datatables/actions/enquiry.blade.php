	@if($data->deleted_at != null)

	 <button type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="false" onclick="restore('Enquiry', '{{ $data->id }}')" title="Click here to Restore">Restore</button>

	@else

		<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
			
		<div class="dropdown-menu">
	
		@if($data->status == 1)
	 
	  		<a class="dropdown-item" href="javascript:void(0)" title="Rejected " onclick="update_status(2,'Enquiry', '{{ $data->id }}')"><i class="la la-exclamation"></i> Reject
	  		</a>
		
		@elseif($data->status == 2)

			<a class="dropdown-item" href="javascript:void(0)" title="Accepted" onclick="update_status(1,'Enquiry', '{{ $data->id }}')"><i class="la la-exclamation"></i> Accept</a>

		@else

			<a class="dropdown-item" href="javascript:void(0)" title="Reject Enquiry" onclick="update_status(2,'Enquiry', '{{ $data->id }}')"><i class="la la-exclamation"></i> Reject

			<a class="dropdown-item" href="javascript:void(0)" title="Accept Enquiry" onclick="update_status(1,'Enquiry', '{{ $data->id }}')"><i class="la la-exclamation"></i> Accept</a>


		@endif	

	  	<a class="dropdown-item" href="{{ $app_url.'enquiries/'.$data->id.'/edit' }}" title="Edit Enquiry"><i class="la la-edit"></i> Edit Enquiry</a>

	  	<a class="dropdown-item"  href="{{$app_url.'enquiries/'.$data->id}}" title="Enquiry Details"><i class="la la-edit"></i> Details </a> 
	  	
	  	<a class="dropdown-item" onclick="delete_record('Enquiry', '{{ $data->id }}')" href="#" title="Delete Enquiry" ><i class="la la-trash"></i> Delete </a>   

</div>

	@endif  	                         

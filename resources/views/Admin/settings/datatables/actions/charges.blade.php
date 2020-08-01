
@if($data->deleted_at != null)

	<button type="button" class="btn btn-danger btn-sm" title="Click here to Restore" onclick="restore('Charge', '{{ $data->id }}')" style="width: 75px;" href="javascript:void(0)">Restore</button>

@else

	<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
<div class="dropdown-menu">

        @if($data->status == 1)
	
	  		<a class="dropdown-item" href="javascript:void(0)" title="Make Inactive Charge" onclick="update_status(0,'Charge', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Inactive
	  		</a>
		
		@else	
			<a class="dropdown-item" href="javascript:void(0)" title="Make Active Charge" onclick="update_status(1,'Charge', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
			
		@endif	

		<a class="dropdown-item" href="{{ $app_url.'passengers/'.$data->id.'/edit' }}" title="Edit Charge"><i class="la la-edit"></i> Edit Charge</a>
 		  	
	  	<a class="dropdown-item" href="#" title="Delete Charge" onclick="delete_record('Charge', '{{ $data->id }}')"><i class="la la-trash"></i> Delete </a>    

	@endif  	                         

</div>


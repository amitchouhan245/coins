@if($data->deleted_at != null)

	<span class="badge bg-danger" title="Deleted" id="{{ $data->id}}">Deleted</span>

@else

	@if($data->status == 1)

		<span class="badge bg-teal" title="Active" id="{{ $data->id}}">Accepted</span>
		
	@else

		<span class="badge bg-warning" title="Inactive" id="{{ $data->id}}">Rejected</span>                

	@endif
	
@endif
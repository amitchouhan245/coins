	@if($data->deleted_at != null)

	 <button type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="false" onclick="restore('Support', '{{ $data->id }}')" title="Click here to Restore">Restore</button>

	@else

		<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
			
		<div class="dropdown-menu">
	
			@if($data->status == 0)

				<a class="dropdown-item" href="{{ $app_url.'support-reply/'.$data->id }}" title="Reply To User"><i class="la la-wechat"></i> Reply..</a>
		
			
			@else	

               <!--  <a class="dropdown-item" href="{{ $app_url.'edit-banner/'.$data->id }}" title="Reply To User"><i class="la la-info"></i> Detail</a> -->

			@endif	
				
			<a class="dropdown-item" onclick="delete_record('Support', '{{ $data->id }}')" href="#" title="Delete Support " ><i class="la la-trash"></i> Delete </a>   
	</div>

	@endif  	                         

<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
<div class="dropdown-menu">
	
	@if($data->deleted_at != null)
	 
		<a class="dropdown-item" href="javascript:void(0)" title="Click here to Restore" >Restore Configuration</a>
	
	@else

		@if($data->status == 1)
	
	  		<a class="dropdown-item" href="javascript:void(0)" title="Make Inactive Configuration" onclick="update_status(0,'Configuration', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Inactive
	  		</a>
		
		@else	
			<a class="dropdown-item" href="javascript:void(0)" title="Make Active Configuration" onclick="update_status(1,'Configuration', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
			
		@endif	

	  	<a class="dropdown-item" href="{{ $app_url.'configuration/'.$data->id.'/edit' }}" title="Edit Configuration"><i class="la la-edit"></i> Edit Configuration</a>

	  	<!-- <a class="dropdown-item"  href="" title="State Details"><i class="la la-info"></i> State Details</a> -->
 		  	
	  	<a class="dropdown-item" onclick="delete_record('Configuration', '{{ $data->id }}')" href="#" title="Delete Configuration" ><i class="la la-trash"></i> Delete </a>    

	@endif  	                         
	
</div>

<script type="text/javascript">
    
	function deletedConfiguration(id) {

		swal({

			title: "Are you sure?",
			text: "You want to delete this record",
			icon: "warning",
			buttons: true,
			dangerMode: true,

		})
		.then((willDelete) => {

			if (willDelete) {

				$.ajax({

					url      : '{{ $app_url.'configuration') }}'+'/'+id,
					type     : 'DELETE', 
					headers  : headers,
					success: function(res) {

						ajax_success(res, '{{ $app_url.'configuration') }}');

					},
					error: function(error) {

						ajax_error(error, btnId, btnText);              

					}
				});	
			} 
		});
	}
</script>
<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
<div class="dropdown-menu">
	
	@if($data->deleted_at != null)
	 
		<a class="dropdown-item" href="javascript:void(0)" title="Click here to Restore" >Restore Cancel Reason</a>
	
	@else

		@if($data->status == 1)
	
	  		<a class="dropdown-item" href="javascript:void(0)" title="Make Inactive CancelReason" onclick="update_status(0,'CancelReason', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Inactive
	  		</a>
		
		@else	
		
			<a class="dropdown-item" href="javascript:void(0)" title="Make Active CancelReason" onclick="update_status(1,'CancelReason', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
			
		@endif	

	  	<a class="dropdown-item" href="{{ $app_url .'cancel-reasons/'.$data->id.'/edit' }}" title="Edit Cancel Reason"><i class="la la-edit"></i> Edit Cancel Reason</a>

	  	<!-- <a class="dropdown-item"  href="" title="State Details"><i class="la la-info"></i> State Details</a> -->
 		  	
	  	<a class="dropdown-item" onclick="delete_record('CancelReason', '{{ $data->id }}')" href="#" title="Delete Cancel Reason" ><i class="la la-trash"></i> Delete </a>    

	@endif  	                         
	
</div>

<script type="text/javascript">
    
	function deletedCancelReason(id) {

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

					url      : APP_URL + 'cancel-reasons/' + id,
					type     : 'DELETE', 
					headers  : headers,
					success: function(res) {

						ajax_success(res, APP_URL + 'cancel-reasons');

					},
					error: function(error) {

						ajax_error(error, btnId, btnText);              

					}
				});	
			} 
		});
	}
</script>
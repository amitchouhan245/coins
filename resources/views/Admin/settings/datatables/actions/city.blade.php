<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
<div class="dropdown-menu">
	
	@if($data->deleted_at != null)
	 
		<a class="dropdown-item" href="javascript:void(0)" title="Click here to Restore" >Restore City</a>
	
	@else

		@if($data->status == 1)
	
	  		<a class="dropdown-item" href="javascript:void(0)" title="Make Inactive City"  onclick="update_status(0,'City', '{{ $data->id }}')" ><i class="la la-exclamation"></i> Make Inactive
	  		</a>
		
	  	<a class="dropdown-item" href="{{ $app_url.'cities/'.$data->id.'/edit' }}" title="Edit City"><i class="la la-edit"></i> Edit City</a>

	  	<!-- <a class="dropdown-item"  href="" title="City Details"><i class="la la-info"></i> City Details</a> -->
 		  	
	  	<a class="dropdown-item" onclick="deleteCity({{$data->id}});" href="#" title="Delete City" ><i class="la la-trash"></i> Delete </a>    
		@else	
			<a class="dropdown-item" href="javascript:void(0)" title="Make Active City" onclick="update_status(1,'City', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
			
		@endif	


	@endif  	                         
	
</div>

<script type="text/javascript">
    
	function deleteCity(id) {

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

					url      : APP_URL + 'cities'+'/'+id,
					type     : 'DELETE', 
					headers  : headers,
					success: function(res) {

						ajax_success(res, APP_URL + 'cities');

					},
					error: function(error) {

						ajax_error(error, btnId, btnText);              

					}
				});	
			} 
		});
	}
</script>
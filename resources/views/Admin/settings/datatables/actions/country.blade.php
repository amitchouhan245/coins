	@if($data->deleted_at != null)

	<button type="button" class="btn btn-danger  btn-sm"  aria-haspopup="true" aria-expanded="false" onclick="restore('Country', {{$data->id }});">Restore</button>

	 
		<!-- <a class="dropdown-item" onclick="restore('Country', {{$data->id }});" href="javascript:void(0)" title="Click here to Restore" >Restore Country</a> -->
	
	@else

<button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
<div class="dropdown-menu">
	

		@if($data->status == 1)
	
	  		<!-- <a class="dropdown-item" href="javascript:void(0)" title="Make Inactive Country" ><i class="la la-exclamation"></i> Make Inactive
	  		</a> -->
		
		@else	
			<!-- <a class="dropdown-item" href="javascript:void(0)" title="Make Active Country" ><i class="la la-exclamation"></i> Make Active</a> -->
			
		@endif	

	  	<a class="dropdown-item" href="{{ $app_url.'countries/'.$data->id.'/edit' }}" title="Edit Country"><i class="la la-edit"></i> Edit Country</a>

	  	<!-- <a class="dropdown-item"  href="" title="Country Details"><i class="la la-info"></i> Country Details</a> -->
 		  	
	  	<a class="dropdown-item" onclick="delete_record('Country', {{$data->id }});" href="#" title="Delete Country" ><i class="la la-trash"></i> Delete </a>    
</div>
	@endif  	                         

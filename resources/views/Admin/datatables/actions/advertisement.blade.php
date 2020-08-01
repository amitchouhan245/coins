@if($data->deleted_at != null)

<button type="button" class="btn btn-danger btn-sm" aria-haspopup="true" aria-expanded="false" onclick="restore('Advertisement', '{{ $data->id }}')" title="Click here to Restore">Restore</button>

@else

   <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
       
   <div class="dropdown-menu">

       @if($data->status == 1)
   
           <a class="dropdown-item" href="javascript:void(0)" title="Make Inactive" onclick="update_status(0,'Advertisement', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Inactive
           </a>
       
       @else	
           <a class="dropdown-item" href="javascript:void(0)" title="Make Active" onclick="update_status(1,'Advertisement', '{{ $data->id }}')"><i class="la la-exclamation"></i> Make Active</a>
           
       @endif	

       <a class="dropdown-item" href="{{$app_url.'edit-advertisement/'.$data->id}}" title="Edit"><i class="la la-edit"></i> Edit</a>

       <a class="dropdown-item"  href="{{$app_url.'advertisement-detail/'.$data->id}}" title="Detail"><i class="la la-edit"></i> Details </a> 
                  
       <a class="dropdown-item" onclick="delete_record('Advertisement', '{{ $data->id }}')" href="#" title="Delete Advertisement Service" ><i class="la la-trash"></i> Delete </a>   

</div>

@endif  	                         

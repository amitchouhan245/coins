<style type="text/css">

	.detail-img {

		height: 40px;
		display: block;
		margin-left: auto;
		margin-right: auto;
		width: 50px;
	}

	.rounded {

		border-radius: 100% !important;
		overflow: hidden;
		width: 50px;
		height: 50px;
		float: left;
	}

</style>


     @if($data->image !="")
  
        <a  class = "fancybox" href="{{url(Config::get('constants.BANNER').$data->image )}}">

        	{!! Html::image(Config::get('constants.BANNER_THUMBNAIL').$data->image,'',['alt' => 'Banner Image','class' => 'img-square detail-img'])!!}
          
        </a>
                                                            
    @else
      
  		<img  class="img-square detail-img" src="{{ asset('public/uploads/no-image.png')}}" />
  		
    @endif
    
    <a class="info" title="Banner Title"> {{ ucwords(@$data->title) }} </a> 
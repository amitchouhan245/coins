@if(!empty($data->drivers))
<a href="{{$app_url.'drivers/'.$data->driver_id}}">{{ $data->drivers->name  }}</a>
@else
--
@endif
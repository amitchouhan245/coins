@if(!empty($data->passengers))
<a href="{{$app_url.'passengers/'.$data->passenger_id}}">{{ $data->passengers->name  }}</a>
@else
--
@endif
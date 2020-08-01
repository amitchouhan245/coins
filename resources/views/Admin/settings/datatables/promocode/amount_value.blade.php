@if($data->type == 1)

	{{ Config::get('constants.CURRENCY') }}{{ $data->value }} 

@else

	{{ number_format($data->value,2) }}%

@endif
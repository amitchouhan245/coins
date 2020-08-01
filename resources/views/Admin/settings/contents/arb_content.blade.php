<style type="text/css">

	.text_area {

		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		line-height: 16px;     /* fallback */
		max-height: 32px;      /* fallback */
		-webkit-line-clamp: 2; /* number of lines to show */
		-webkit-box-orient: vertical;
	}
</style>

<div class="text_area">{{ strip_tags(@$data->arabic) }}</div>
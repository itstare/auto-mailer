@extends('layouts.app')
@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
	    	{{ $template->title }}
	    </div>
	    <div class="card-body">
	    	{!! $template->body !!}
	    </div>
	</div>
</div>
@endsection
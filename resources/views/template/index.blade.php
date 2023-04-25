@extends('layouts.app')
@section('content')
<div class="container">
	@if(session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  		{{ session()->get('status') }}
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif

	@if($templates->count() > 0)
	<div class="row">
		<div class="col-md-3">
			<form action="{{ route('template.search') }}" method="GET">
				<div class="input-group">
  					<input type="search" name="term" class="form-control" placeholder="Search templates..." required>
  					<div class="input-group-append">
    					<button class="btn btn-primary">Search</button>
  					</div>
				</div>
			</form>
		</div>

		<div class="col-md-9 d-flex justify-content-end">
			<a href="{{ route('template.delete-all') }}" class="btn btn-danger ms-2">Delete All Templates</a>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-6">
			<h4>Title</h4>
		</div>
		<div class="col-md-2">
			<h4>Last time used</h4>
		</div>
	</div>

	@foreach($templates as $template)
	<div class="row my-3">
		<div class="col-md-6">
			{{ $template->title }}
		</div>

		<div class="col-md-2">
			{{ $template->lastTimeUsed() }}
		</div>

		<div class="col-md-4 d-flex justify-content-end">
			<a href="{{ route('template.view', $template->id) }}" class="btn btn-primary btn-sm ms-2">View</a>
			<a href="{{ route('template.edit', $template->id) }}" class="btn btn-warning btn-sm ms-2">Edit</a>
			<a href="{{ route('template.delete', $template->id) }}" class="btn btn-danger btn-sm ms-2">Delete</a>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="d-flex justify-content-center mt-4">
		@if(isset($term))
		{{ $templates->appends(['term' => $term])->links() }}
		@else
		{{ $templates->links() }}
		@endif
	</div>
	@else
	<div class="d-flex justify-content-center">
		@if(isset($term))
		<h2>0 templates found.</h2>
		@else
		<h2>There are 0 templates added.</h2>
		@endif
	</div>
	@endif
</div>
@endsection
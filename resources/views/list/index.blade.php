@extends('layouts.app')
@section('content')
<div class="container">
	@if(session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  		{{ session()->get('status') }}
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif

	@if($lists->count() > 0)
	<div class="row">
		<div class="col-md-3">
			<form action="{{ route('list.search') }}" method="GET">
				<div class="input-group">
  					<input type="search" name="term" class="form-control" placeholder="Search lists..." required>
  					<div class="input-group-append">
    					<button class="btn btn-primary">Search</button>
  					</div>
				</div>
			</form>
		</div>

		<div class="col-md-9 d-flex justify-content-end">
			<a href="{{ route('list.delete-all') }}" class="btn btn-danger ms-2">Delete All Lists</a>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-4">
			<h4>Title</h4>
		</div>

		<div class="col-md-2">
			<h4>Unused emails</h4>
		</div>

		<div class="col-md-2">
			<h4>Used emails</h4>
		</div>

		<div class="col-md-2">
			<h4>Total emails</h4>
		</div>
	</div>

	@foreach($lists as $list)
	<div class="row my-3">
		<div class="col-md-4">
			{{ $list->title }}
		</div>

		<div class="col-md-2 text-success">
			{{ $list->unusedEmails() }}
		</div>

		<div class="col-md-2 text-danger">
			{{ $list->usedEmails() }}
		</div>

		<div class="col-md-2 text-primary">
			{{ $list->totalEmails() }}
		</div>

		<div class="col-md-2 d-flex justify-content-end">
			<a href="{{ route('list.view', $list->id) }}" class="btn btn-primary btn-sm ms-2">View</a>
			<a href="{{ route('list.edit', $list->id) }}" class="btn btn-warning btn-sm ms-2">Edit</a>
			<a href="{{ route('list.delete', $list->id) }}" class="btn btn-danger btn-sm ms-2">Delete</a>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="d-flex justify-content-center mt-4">
		@if(isset($term))
		{{ $lists->appends(['term' => $term])->links() }}
		@else
		{{ $lists->links() }}
		@endif
	</div>
	@else
	<div class="d-flex justify-content-center">
		@if(isset($term))
		<h2>0 lists found.</h2>
		@else
		<h2>There are 0 lists added.</h2>
		@endif
	</div>
	@endif
</div>
@endsection
@extends('layouts.app')
@section('content')
<div class="container">
	@if(session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  		{{ session()->get('status') }}
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif

	@if($emails->count() > 0)
	<div class="row">
		<div class="col-md-3">
			<form action="{{ route('email.search') }}" method="GET">
				<div class="input-group">
  					<input type="search" name="term" class="form-control" placeholder="Search emails..." required>
  					<div class="input-group-append">
    					<button class="btn btn-primary">Search</button>
  					</div>
				</div>
			</form>
		</div>

		<div class="col-md-9 d-flex justify-content-end">
			<a href="{{ route('email.reset-all') }}" class="btn btn-success">Reset All Emails</a>
			<a href="{{ route('email.delete-all') }}" class="btn btn-danger ms-2">Delete All Emails</a>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-3">
			<h4>Email</h4>
		</div>

		<div class="col-md-3">
			<h4>Password</h4>
		</div>

		<div class="col-md-3">
			<h4>Used</h4>
		</div>
	</div>

	@foreach($emails as $email)
	<div class="row my-3">
		<div class="col-md-3">
			{{ $email->email }}
		</div>

		<div class="col-md-3">
			{{ $email->password }}
		</div>

		<div class="col-md-3">
			@if($email->isUsed())
			<span class="text-danger">Yes</span>
			@else
			<span class="text-success">No</span>
			@endif
		</div>

		<div class="col-md-3 d-flex justify-content-end">
			@if($email->isUsed())
			<a href="{{ route('email.reset', $email->id) }}" class="btn btn-success btn-sm">Reset</a>
			@endif
			<a href="{{ route('email.edit', $email->id) }}" class="btn btn-warning btn-sm ms-2">Edit</a>
			<a href="{{ route('email.delete', $email->id) }}" class="btn btn-danger btn-sm ms-2">Delete</a>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="d-flex justify-content-center mt-4">
		@if(isset($term))
		{{ $emails->appends(['term' => $term])->links() }}
		@else
		{{ $emails->links() }}
		@endif
	</div>
	@else
	<div class="d-flex justify-content-center">
		@if(isset($term))
		<h2>0 emails found.</h2>
		@else
		<h2>There are 0 emails added.</h2>
		@endif
	</div>
	@endif
</div>
@endsection
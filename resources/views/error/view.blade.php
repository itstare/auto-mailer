@extends('layouts.app')
@section('content')
<div class="container">
	@if(session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  		{{ session()->get('status') }}
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif

	@if($errors->count() > 0)
	<div class="row">
		<div class="col-md-12 d-flex justify-content-end">
			<a href="{{ route('error.delete-all-errors', $id) }}" class="btn btn-danger ms-2">Delete All Errors</a>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-3">
			<h4>Email</h4>
		</div>
		<div class="col-md-6">
			<h4>Error Message</h4>
		</div>
	</div>

	@foreach($errors as $error)
	<div class="row my-3">
		<div class="col-md-3">
			{{ $error->email->email }}
		</div>

		<div class="col-md-6">
			{{ $error->error_msg }}
		</div>

		<div class="col-md-3 d-flex justify-content-end">
			<a href="{{ route('error.delete-error', ['id' => $error->id, 'sessionId' => $id]) }}" class="btn btn-danger btn-sm ms-2">Delete</a>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="d-flex justify-content-center mt-4">
		{{ $errors->links() }}
	</div>
	@else
	<div class="d-flex justify-content-center">
		<h2>There are 0 errors found.</h2>
	</div>
	@endif
</div>
@endsection
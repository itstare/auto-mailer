@extends('layouts.app')
@section('content')
<div class="container">
	@if(session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  		{{ session()->get('status') }}
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif

	@if($logs->count() > 0)
	<div class="row">
		<div class="col-md-12 d-flex justify-content-end">
			<a href="{{ route('error.delete-all') }}" class="btn btn-danger ms-2">Delete All Logs</a>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-3">
			<h4>Template</h4>
		</div>
		<div class="col-md-3">
			<h4>Subject</h4>
		</div>
		<div class="col-md-2">
			<h4>Sent Date</h4>
		</div>
		<div class="col-md-2">
			<h4>Errors</h4>
		</div>
	</div>

	@foreach($logs as $log)
	<div class="row my-3">
		<div class="col-md-3">
			{{ $log->template_title }}
		</div>

		<div class="col-md-3">
			{{ $log->email_subject }}
		</div>

		<div class="col-md-2">
			{{ $log->sentDate() }}
		</div>

		<div class="col-md-2 @if($log->noErrors() < 1) text-primary @else text-danger @endif">
			{{ $log->noErrors() }}
		</div>

		<div class="col-md-2 d-flex justify-content-end">
			@if($log->noErrors() > 0)
			<a href="{{ route('error.view', $log->id) }}" class="btn btn-primary btn-sm ms-2">View</a>
			@endif
			<a href="{{ route('error.delete', $log->id) }}" class="btn btn-danger btn-sm ms-2">Delete</a>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="d-flex justify-content-center mt-4">
		{{ $logs->links() }}
	</div>
	@else
	<div class="d-flex justify-content-center">
		<h2>There are 0 logs found.</h2>
	</div>
	@endif
</div>
@endsection
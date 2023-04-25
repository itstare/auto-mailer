@extends('layouts.app')
@section('content')
<div class="container">
	@if(session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  		{{ session()->get('status') }}
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	@endif

	@if($customers->count() > 0)
	<div class="row">
		<div class="col-md-3">
			<form action="{{ route('customer.search', request('id')) }}" method="GET">
				<div class="input-group">
  					<input type="search" name="term" class="form-control" placeholder="Search emails..." required>
  					<div class="input-group-append">
    					<button class="btn btn-primary">Search</button>
  					</div>
				</div>
			</form>
		</div>

		<div class="col-md-9 d-flex justify-content-end">
			<a href="{{ route('customer.resetAll', request('id')) }}" class="btn btn-success">Reset All Emails</a>
		</div>
	</div>

	<div class="row mt-4">
		<div class="col-md-6">
			<h4>Email</h4>
		</div>

		<div class="col-md-4">
			<h4>Sent</h4>
		</div>
	</div>

	@foreach($customers as $customer)
	<div class="row my-3">
		<div class="col-md-6">
			{{ $customer->email }}
		</div>

		<div class="col-md-4 @if($customer->used) text-danger @else text-success @endif">
			{{ $customer->sent() }}
		</div>

		<div class="col-md-2 d-flex justify-content-end">
			<a href="{{ route('customer.delete', ['listId' => request('id'), 'id' => $customer->id]) }}" class="btn btn-danger btn-sm ms-2">Delete</a>
		</div>
	</div>
	<hr>
	@endforeach

	<div class="d-flex justify-content-center mt-4">
		@if(isset($term))
		{{ $customers->appends(['term' => $term])->links() }}
		@else
		{{ $customers->links() }}
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
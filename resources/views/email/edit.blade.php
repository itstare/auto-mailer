@extends('layouts.app')
@section('content')
<div class="container w-50">
	<div class="card">
		<div class="card-header">
	    	Edit | {{ $email->email }}
	    </div>
	    <div class="card-body">
	    	<form action="{{ route('email.update', $email->id) }}" method="POST">
	    		<div class="form-group">
	    			<label for="email">Email</label>
	    			<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $email->email }}" required>

	    			@error('email')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<div class="form-group mt-2">
	    			<label for="password">Password</label>
	    			<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ $email->password }}" required>

	    			@error('password')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<button class="btn btn-primary mt-3">Update</button>
	    		@csrf
	    	</form>
	    </div>
	</div>
</div>
@endsection
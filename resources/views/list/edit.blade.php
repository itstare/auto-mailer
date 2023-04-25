@extends('layouts.app')
@section('content')
<div class="container w-50">
	<div class="card">
		<div class="card-header">
	    	Edit | {{ $list->title }}
	    </div>
	    <div class="card-body">
	    	<form action="{{ route('list.update', $list->id) }}" method="POST">
	    		<div class="form-group">
	    			<label for="title">Title</label>
	    			<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $list->title }}" required>

	    			@error('title')
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
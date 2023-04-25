@extends('layouts.app')
@section('content')
<div class="container w-50">
	<div class="card">
		<div class="card-header">
	    	Create a template
	    </div>
	    <div class="card-body">
	    	<form action="{{ route('template.insert') }}" method="POST">
	    		<div class="form-group">
	    			<label for="title">Title</label>
	    			<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required>

	    			@error('title')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<div class="form-group mt-2">
	    			<label for="body">Body</label>
	    			<textarea name="body" rows="18" class="form-control @error('body') is-invalid @enderror"></textarea>

	    			@error('body')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<button class="btn btn-primary mt-3">Create</button>
	    		@csrf
	    	</form>
	    </div>
	</div>
</div>
@endsection

@section('scripts')
@include('partials.tiny-mce')
@endsection
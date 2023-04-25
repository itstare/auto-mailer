@extends('layouts.app')
@section('content')
<div class="container w-50">
	<div class="card">
		<div class="card-header">
	    	Edit | {{ $template->title }}
	    </div>
	    <div class="card-body">
	    	<form action="{{ route('template.update', $template->id) }}" method="POST">
	    		<div class="form-group">
	    			<label for="title">Title</label>
	    			<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ $template->title }}" required>

	    			@error('title')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<div class="form-group mt-2">
	    			<label for="body">Body</label>
	    			<textarea name="body" rows="18" class="form-control @error('body') is-invalid @enderror">{{ $template->body }}</textarea>

	    			@error('body')
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

@section('scripts')
@include('partials.tiny-mce')
@endsection
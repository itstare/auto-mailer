@extends('layouts.app')
@section('content')
<div class="container w-50">
	@if(session('status'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
  		{{ session()->get('status') }}
  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

	<div class="card">
		<div class="card-header">
	    	Send Emails
	    </div>
	    <div class="card-body">
	    	<form action="{{ route('send') }}" method="POST">
	    		<div class="form-group">
	    			<label for="list">List</label>
	    			<select name="list" class="form-select @error('list') is-invalid @enderror">
  						@foreach($emailLists as $list)
  						<option value="{{ $list->id }}">{{ $list->formString() }}</option>
  						@endforeach
					</select>

	    			@error('list')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<div class="form-group mt-2">
	    			<label for="emails">Emails (max: {{ $emails }})</label>
	    			<input type="number" name="emails" class="form-control @error('emails') is-invalid @enderror" min="1" max="{{ $emails }}" required>

	    			@error('emails')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<div class="form-group mt-2">
	    			<label for="template">Template</label>
	    			<select name="template" class="form-select @error('template') is-invalid @enderror">
  						@foreach($templates as $template)
  						<option value="{{ $template->id }}">{{ $template->title }}</option>
  						@endforeach
					</select>

	    			@error('template')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<div class="form-group mt-2">
	    			<label for="subject">Subject</label>
	    			<input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" required>

	    			@error('subject')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<button class="btn btn-primary mt-3">Send</button>
	    		@csrf
	    	</form>
	    </div>
	</div>
</div>
@endsection
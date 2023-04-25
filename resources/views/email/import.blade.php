@extends('layouts.app')
@section('content')
<div class="container w-50">
	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

	<div class="card">
		<div class="card-header">
	    	Import emails from Excel file
	    </div>
	    <div class="card-body">
	    	<form action="{{ route('email.upload') }}" method="POST" enctype="multipart/form-data">
	    		<div class="form-group">
	    			<label for="file">Upload .xlsx file</label>
	    			<input type="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>

	    			@error('file')
	    			<span class="invalid-feedback" role="alert">
                		<strong>{{ $message }}</strong>
            		</span>
	    			@enderror
	    		</div>

	    		<button class="btn btn-primary mt-3">Upload</button>
	    		@csrf
	    	</form>
	    </div>
	</div>
</div>
@endsection
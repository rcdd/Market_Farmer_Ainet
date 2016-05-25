@if (count($errors))
	<div class="alert alert-danger">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <ul>
	    @foreach ($errors->all() as $field => $message)
	        {{$message}}
	    @endforeach
	    </ul>
	</div>
@endif

@extends('layouts.app')

@section('stylesheets')

	<link rel="stylesheet" href="/css/select2.min.css">

@endsection

@section('content')

<div class="container">
	<div class="row">
		
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="well">
				<form class="form-horizontal" method="POST" action="{{ route('news.store') }}">
                        {{ csrf_field() }}
				<h2>New News</h2><br><br>
				<label for="">Title :</label>
				<input type="text" class="form-control" name="title"><br>
				<label for="">Status :</label>
				<select name="status" class="form-control">
					<option value="" disabled="">Choose one..</option>
					<option value="Published">Published</option>
					<option value="Draft">Draft</option>
					<option value="Deleted">Deleted</option>
				</select><br>
				<label for="">Topic :</label>
				<select class="form-control select2-multi" name="topics[]" multiple="multiple">
					@foreach($topics as $topic)
						<option value='{{ $topic->id }}'>{{ $topic->topic_name }}</option>
					@endforeach

				</select><br><br>
				<label for="">Body :</label>
				<textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea><br>
				<button type="submit" class="btn btn-primary btn-block btn-h1-spacing">Create New News</button>
                </form>
				
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>

@endsection

@section('scripts')

	<script src="/js/select2.min.js"></script>

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>

@endsection
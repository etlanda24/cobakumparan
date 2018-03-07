@extends('layouts.app')
@section('stylesheets')

	<link rel="stylesheet" href="/css/select2.min.css">

@endsection
@section('title', '| All Topics')

@section('content')
<form class="form-horizontal" method="POST" action="{{ route('news.update',$news->id) }}">
	<div class="row">
		<div class="col-md-8">
			<div class="well">
				<input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
				<h2>Edit News</h2><br><br>
				<label for="">Title :</label>
				<input type="text" class="form-control" name="title" value="{{$news->title}}"><br>
				<label for="">Status :</label>
				<select name="status" class="form-control">				
					<option value="Published" @if ($news->status=="Published")
					selected
					@endif>Published</option>
					<option value="Draft" @if ($news->status=="Draft")
					selected
					@endif>Draft</option>
					<option value="Deleted" @if ($news->status=="Deleted")
					selected
					@endif>Deleted</option>
				</select><br>
				<label for="">Topic :</label>
				<select class="form-control select2-multi" name="topics[]" multiple="multiple">
					
					{{-- @foreach ($news->topics as $topic)
					<option value="{{$topic->id}}" selected="">{{$topic->topic_name}}</option>
					@endforeach
				
					@foreach($topics as $topic)
						<option value='{{ $topic->id }}'>{{ $topic->topic_name }}</option>
					@endforeach --}}

					@foreach ($topics as $topic)
					{{-- <option value="{{$topic->id}}" selected="">{{$topic->topic_name}}</option>
 --}}
						@php
							$nilai = 0;
						@endphp

						@foreach($news->topics as $topic2)
							@if ($topic->id == $topic2->id)
								<option value='{{ $topic->id }}' selected>{{ $topic->topic_name }}</option>
								
							@php
								$nilai = 1;
							@endphp
							
							@endif
						@endforeach


						@if ($nilai != 1)						
							<option value='{{ $topic->id }}' >{{ $topic->topic_name }}</option>
						@endif


					@endforeach
				
					

					
				


				</select><br><br>
				<label for="">Body :</label>
				<textarea name="body" id="" cols="30" rows="10" class="form-control">{{$news->body}}</textarea><br>
				
				
			</div>
		</div> <!-- end of .col-md-8 -->

		<div class="col-md-4">
			<div class="well">				
				<label for="">Created At :</label>
				<p>{{ date('M j, Y', strtotime($news->created_at)) }}</p>
				<label for="">Last Updated :</label>
				<p>{{ date('M j, Y', strtotime($news->updated_at)) }}</p>
				<div class="row">
					<div class="col-md-6">		
						<button type="submit" class="btn btn-primary btn-block btn-h1-spacing">Save</button>
					</div>
					<div class="col-md-6">
						<a href="/news" class="btn btn-danger btn-block btn-h1-spacing">Cancel</a>
					</div>
                </div>
				
			</div>
		</div>
	</div>
</form>
@endsection
@section('scripts')

	<script src="/js/select2.min.js"></script>

	<script type="text/javascript">
		$('.select2-multi').select2();
	</script>

@endsection
@extends('layouts.app')

@section('title', '| News')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>{{$news->title}}</h1><hr>
			<h4>{{$news->body}}</h4>
			
		</div> <!-- end of .col-md-8 -->

		<div class="col-md-4">
			<div class="well">
				
				<div>
					<label for="">Url :</label>
					<p><a href="{{ route('news.show', $news->title_slug)}}">{{ route('news.show', $news->title_slug)}}</a></p>
				</div>

				<div style="margin-bottom: 10px;">
					<label for="">Topics :</label>
					<div class="topics">
						@foreach ($news->topics as $topic)
							<span class="label label-default">{{$topic->topic_name}}</span>
						@endforeach
					</div>
				</div>

				<div>
					<label for="">Created At :</label>
					<p>{{ date('M j, Y', strtotime($news->created_at)) }}</p>
				</div>

				<div>
					<label for="">Last Updated :</label>
					<p>{{ date('M j, Y', strtotime($news->updated_at)) }}</p>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6"><a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary btn-block btn-h1-spacing">Edit</a></div>
					<div class="col-md-6">
					<form method="POST" action="{{ route('news.destroy',$news->id) }}">
						<input type="hidden" name="_method" value="DELETE">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-danger btn-block btn-h1-spacing">Delete</button>
					</form>
					</div>
				</div>
				<div class="row">
				<div class="col-md-12" style="margin-top: 20px;" ><a href="/news" class="btn btn-default btn-block btn-h1-spacing">See All Post</a></div>
				</div>
               
				
			</div>
		</div>
	</div>

@endsection
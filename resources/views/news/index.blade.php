@extends('layouts.app')

@section('title', '| All News')

@section('content')

	<div class="row">
		<div class="col-md-10">
		<h1>News</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('news.create') }}" class="btn btn-primary" style="margin-top: 20px;">Create News</a>
		</div>

		<div class="col-md-12">
			<hr>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Body</th>
						<th>Created</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($news as $news)
						<tr>
							<th>{{ $news->id }}</th>
							<td><a href="/news/{{$news->id}}">{{ $news->title }}</a></td>
							<td>{{ substr($news->body, 0, 50) }}{{ strlen($news->body) > 50 ? "..." : "" }}</td>
							<td>{{ date('M j, Y', strtotime($news->created_at)) }}</td>
							<td><a href="{{ route('news.show', $news->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('news.edit', $news->id) }}" class="btn btn-default btn-sm">Edit</a></td>
						</tr>
					@endforeach										
				</tbody>
			</table>
		</div> <!-- end of .col-md-8 -->

		
	</div>

@endsection
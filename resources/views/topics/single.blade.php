@extends('layouts.app')

@section('title', '| All Topics')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1 style="font-weight: bold">{{ $topic->topic_name }} Topic <small>({{$topic->news()->count()}} News)</small></h1>
			<hr>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Title </th>
						<th>Body</th>
						<th>Topics</th>
						<th>Created At</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($topic->news as $news)
						<tr>
							<th>{{ $news->id }}</th>
							<td><a href="{{ route('news.show',$news->id) }}">{{ $news->title }}</a></td>
							<td>{{$news->body}}</td>
							<td>
							@foreach ($news->topics as $news)			
								@if ($news->id == $topic->id)								
								<span class="label label-primary">{{$news->topic_name}}</span>
								@else
								<span class="label label-default">{{$news->topic_name}}</span>
								@endif					
								
							@endforeach
							</td>
							<td>{{ date('M j, Y', strtotime($news->created_at)) }}</td>
						</tr>
					@endforeach										
				</tbody>
			</table>
			
		</div> <!-- end of .col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				<form class="form-horizontal" method="POST" action="{{ route('topics.update',$topic->id) }}">
				<input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
				<h2>Edit Topic</h2>
				<label for="">Topic Name :</label>
				<input type="text" class="form-control" name="topic_name" value="{{ $topic->topic_name }}"><br>
				
				<div class="row">
					<div class="col-md-6">
					<button type="submit" class="btn btn-primary btn-block btn-h1-spacing">Save</button>
					</div>
				</form>
					<div class="col-md-6">
						<form method="POST" action="{{ route('topics.destroy',$topic->id) }}">
							<input type="hidden" name="_method" value="DELETE">
							{{ csrf_field() }}
							<button type="submit" class="btn btn-danger btn-block btn-h1-spacing">Delete</button>
						</form>
                	</div>
                </div>
                <div class="row">
                	<div class="col-md-12" style="margin-top: 15px;">
                		<a href="{{ route('topics.index') }}" class="btn btn-default btn-block btn-h1-spacing">Back</a>
                	</div>
                </div>
                
				
			</div>
		</div>
	</div>

@endsection
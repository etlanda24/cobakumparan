@extends('layouts.app')

@section('title', '| All Topics')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Topics</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Topic Name</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					@foreach ($topics as $topic)
						<tr>
							<th>{{ $topic->id }}</th>
							<td><a href="{{ route('topics.show',$topic->id) }}">{{ $topic->topic_name }}</a></td>
							<td>
								<form method="POST" action="{{ route('topics.destroy',$topic->id) }}">
								<input type="hidden" name="_method" value="DELETE">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-danger">x</button>
								</form>
							</td>
						</tr>
					@endforeach										
				</tbody>
			</table>
		</div> <!-- end of .col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				<form class="form-horizontal" method="POST" action="{{ route('topics.store') }}">
                        {{ csrf_field() }}
				<h2>New Topic</h2>
				<label for="">Topic Name :</label>
				<input type="text" class="form-control" name="topic_name"><br>
				<button type="submit" class="btn btn-primary btn-block btn-h1-spacing">Create New Topic</button>
                </form>
				
			</div>
		</div>
	</div>

@endsection
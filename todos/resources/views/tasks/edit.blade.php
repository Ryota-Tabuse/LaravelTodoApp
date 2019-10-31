@extends('layout')

@section('styles')
	@include('share.flatpicker.styles')
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col col-md-offset-3 col-md-6">
				<nav class="panel panel-default">
					<div class="panel-heading">タスク編集する</div>
					<div class="panel-body">
						@if($errors->any())
							<div class="alert alert-danger">
								@foreach ($errors->all() as $message)
									<p>{{$message}}</p>
								@endforeach
							</div>
						@endif
						<form action="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}" method="POST">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="title">タイトル</label>
								<input type="text" name="title" id="title" value="{{ old('title') ?? $task->title}}" class="form-control">
							</div>
							<div class="form-group">
								<label for="status">状態</label>
								<select name="status" id="status" class="form-control">
									@foreach (\App\Task::STATUS as $key=>$val)
										<option value="{{$key}}"
										{{ $key == old ('status' , $task->status) ? 'selected': ''}}>{{ $val['label']}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label for="sue_date">期限</label>
								<input type="text" class="form-control" name="sue_date" id="sue_date" value="{{old('sue_date') ?? $task->formatted_sue_date}}">
							</div>
							<div class="text-right">
								<button class="btn btn-primary">
									送信
								</button>
							</div>
						</form>
					</div>
				</nav>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	@include('share.flatpicker.scripts')
@endsection
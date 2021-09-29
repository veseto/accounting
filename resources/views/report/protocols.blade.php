@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800"></h1>

<div class="card shadow mb-4">
	<div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
	<div class="card-body">
		<form method="get" action="/report"> 
			<div class="row">
				<div class="col-3 offset-1">
					<label>От дата:</label>
				</div>
				<div class="col-3">
					<label>До дата:</label>
				</div>
			</div>
			<div class="row">
				<div class="col-3 offset-1">
					<input type="text" name="from" class="form-control" id="from">
				</div>
				<div class="col-3">
					<input type="text" name="to" class="form-control" id="to">
				</div>
				<div class="col-3">
					<input type="submit" name="" class="btn btn-primary" value="OK">
				</div>
			</div>
		</form>

		<div>
			<table class="table table-hover table-bordered" style="table-layout: fixed;" id="dataTable">
				<thead class="thead-light">
					<tr>
						<th>дата</th>
						<th>приходи</th>
						<th>разходи</th>
						<th>каса</th>
						<th>наличност</th>
						<th>задължения</th>
					</tr>
				</thead>
				<tbody>
					@foreach($days as $day)
					<tr>
						<td><a href="/report/{{$day->id}}">{{$day->date->format('d.m.Y')}}</a></td>
						<td>{{$day->income}}</td>
						<td>{{$day->expense}}</td>
						<td>{{$day->income - $day->expense}}</td>
						<td>{{$day->availability}}</td>
						<td>{{$day->debt}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
	
		</div>
	</div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
		  $('#dataTable').DataTable({
		  	searching : true,
		  	ordering : true,
		  });
		});
		$('#from').datetimepicker({
        minView: 'month',
        autoclose: true,
        format: 'dd-mm-yyyy',
        weekStart: 1,
        todayHighlight: true,
        todayBtn: true,
        });
	$('#to').datetimepicker({
        minView: 'month',
        autoclose: true,
        format: 'dd-mm-yyyy',
        weekStart: 1,
        todayHighlight: true,
        todayBtn: true,
        });
	</script>
@endsection
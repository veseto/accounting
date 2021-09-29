@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800"></h1>

<div class="card shadow mb-4">
	<div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
    </div>
	<div class="card-body">
		<form method="post" action="/daily/date">
			@csrf
			<div class="form-row">
				<div class="col-4 offset-1">
					<label>За дата</label>
					<input type="text" name="date" id="date">
				</div>
				<div class="col-2">
					<input type="submit" class="btn btn-primary">
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$('#date').datetimepicker({
        minView: 'month',
        autoclose: true,
        format: 'dd-mm-yyyy',
        weekStart: 1,
        todayHighlight: true,
        todayBtn: true,
        });
</script>
@endsection
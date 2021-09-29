@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800"></h1>

<div class="card shadow mb-4">
	<div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Протокол за дата {{$report->date->format('d-m-Y')}}</h6>
    </div>
	<div class="card-body">
		<h4>Приходи</h4>
		<div class="row">
				<div class="col-3 offset-1"> <label>Тип</label> </div>
				<div class="col-2"> <label>лв</label> </div>
				<div class="col-2"> <label>бележки</label> </div>
			</div>
		@foreach($report->incomes as $income)
		<form method="post" action="/report/income/remove/{{$income->id}}">
			@csrf

			
			<div class="form-row">

				<div class="col-3 form-group offset-1">
					<select class="form-control" name="income_types_id" disabled>
						@foreach(App\Models\IncomeType::get() as $incomeType)
							<option value="{{$incomeType->id}}" {{$income->income_type_id == $incomeType->id?"selected":''}}>{{$incomeType->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-2 form-group">
					<input type="number" step="0.01" class="form-control" name="amount" value="{{$income->amount}}" readonly>
				</div>
				<div class="col-3 form-group">
					<input type="text" class="form-control" name="notes" value="{{$income->notes}}" readonly>
				</div>
				<div class="col-2 form-group">
					<button type="submit" class="btn btn-danger">-</button>
				</div>
			</div>
			
		</form>
		@endforeach
		<form method="post" action="/report/income/{{$report->id}}">
			@csrf

			<div class="form-row">

				<div class="col-3 form-group offset-1">
					<select class="form-control" name="income_types_id">
						@foreach(App\Models\IncomeType::get() as $incomeType)
							<option value="{{$incomeType->id}}">{{$incomeType->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-2 form-group">
					<input type="number" step="0.01" class="form-control" name="amount">
				</div>
				<div class="col-3 form-group">
					<input type="text" class="form-control" name="notes">
				</div>
				<div class="col-2 form-group">
					<input type="submit" class="btn btn-primary" value="+">
				</div>
			</div>
			
		</form>
		<h4>Разходи</h4>
		<div class="row">
				<div class="col-3 offset-1"> <label>Тип</label> </div>
				<div class="col-2"> <label>лв</label> </div>
				<div class="col-2"> <label>бележки</label> </div>
			</div>
		@foreach($report->expenses as $exp)
		<form method="post" action="/report/expense/remove/{{$exp->id}}">
			@csrf

			
			<div class="form-row">

				<div class="col-3 form-group offset-1">
					<select class="form-control" name="expenses_types_id" disabled>
						@foreach(App\Models\ExpenseType::get() as $expType)
							<option value="{{$expType->id}}" {{$exp->expense_type_id == $expType->id?"selected":''}}>{{$expType->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-2 form-group">
					<input type="number" step="0.01" class="form-control" name="amount" value="{{$exp->amount}}" readonly>
				</div>
				<div class="col-3 form-group">
					<input type="text" class="form-control" name="notes" value="{{$exp->notes}}" readonly>
				</div>
				<div class="col-2 form-group">
					<button type="submit" class="btn btn-danger">-</button>
				</div>
			</div>
			
		</form>
		@endforeach
		<form method="post" action="/report/expense/{{$report->id}}">
			@csrf

			<div class="form-row">

				<div class="col-3 form-group offset-1">
					<select class="form-control" name="expenses_types_id">
						@foreach(App\Models\ExpenseType::get() as $expType)
							<option value="{{$expType->id}}">{{$expType->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-2 form-group">
					<input type="number" step="0.01" class="form-control" name="amount">
				</div>
				<div class="col-3 form-group">
					<input type="text" class="form-control" name="notes">
				</div>
				<div class="col-2 form-group">
					<button type="submit" class="btn btn-primary">+</button>
				</div>
			</div>
			
		</form>
		Общо приходи: {{$report->income}}<br>
		Общо разходи: {{$report->expense}}<br>
		Каса за деня: {{$report->income - $report->expense}}<br>
		Обща наличност: {{\App\Models\CurrentStat::first()->availability}}<br>
	</div>
</div>
@endsection
@section('scripts')

@endsection
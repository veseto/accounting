@extends('layouts.app')

@section('content')
<h1 class="h3 mb-2 text-gray-800"></h1>

<div class="card shadow mb-4">
	<div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"> Задължения към {{\Carbon\Carbon::today()->format('d-m-Y')}}</h6>
    </div>
	<div class="card-body">
		<h4>Текущи задължения</h4>
		<div class="row">
			<div class="col-3 offset-1"> <label>Тип</label> </div>
			<div class="col-2"> <label>лв</label> </div>
		</div>
		@foreach($current as $debt)
		<form method="post" action="/debt/remove/{{$debt->id}}">
			@csrf
			<div class="form-row">
				<div class="col-3 form-group offset-1">
					<select class="form-control" name="income_types_id" disabled>
						@foreach(App\Models\ExpenseType::get() as $expType)
							<option value="{{$expType->id}}" {{$debt->expenseType->id == $expType->id?"selected":''}}>{{$expType->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-2 form-group">
					<input type="number" step="0.01" class="form-control" name="amount" value="{{$debt->amount}}" readonly>
				</div>
				<div class="col-2 form-group">
					<button type="submit" class="btn btn-danger">-</button>
				</div>
			</div>
			
		</form>
		@endforeach
		<h4>Нови задължения</h4>
		<div class="row">
			<div class="col-3 offset-1"> <label>Тип</label> </div>
			<div class="col-2"> <label>лв</label> </div>
		</div>
		<form method="post" action="/debt/add">
			@csrf
			<div class="form-row">
				<div class="col-3 form-group offset-1">
					<select class="form-control" name="expense_type_id" >
							@foreach(\App\Models\ExpenseType::get() as $expType)
							<option value="{{$expType->id}}">{{$expType->name}}</option>
							@endforeach
					</select>
				</div>
				<div class="col-2 form-group">
					<input type="number" step="0.01" class="form-control" name="amount">
				</div>
				<div class="col-2 form-group">
					<button type="submit" class="btn btn-danger">+</button>
				</div>
			</div>
			
		</form>
	</div>
</div>
@endsection
@section('scripts')

@endsection
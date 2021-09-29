<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use App\Models\CurrentStat;
use App\Models\Day;


use Carbon\Carbon;

class DailyController extends Controller
{
   
    public function showCalendarView()
    {
        return view('daily.calendar');
    }

    public function addDate(Request $request)
    {
        $day = Day::whereDate('date', Carbon::create($request->date))->first();
        return redirect('/report/'.$day->id);
    }

    public function showReportView(Day $report)
    {
        return view('daily.add', compact('report'));
    }
    

    public function submitIncome(Request $request, Day $report)
    {
        $income = Income::create(['income_type_id' => $request->income_types_id, 'amount' => $request->amount, 'notes' => $request->notes, 'day_id' => $report->id]);
        $current = CurrentStat::first();
        $current->update(['availability' => $current->availability += $income->amount]);
        $report->income += $income->amount;
        $report->availability = $current->availability;
        $report->debt = $current->debt;
        $report->save();
        return back();    
    }

    public function removeIncome(Income $income)
    {
        $current = CurrentStat::first();
        $current->update(['availability' => $current->availability -= $income->amount]);
        $report = $income->day;
        $report->income -= $income->amount;
        $report->availability = $current->availability;
        $income->delete();
        $report->debt = $current->debt;
        $report->save();
        return back();    
    }

     public function submitExpense(Request $request, Day $report)
    {
        $expense = Expense::create(['expense_type_id' => $request->expenses_types_id, 'amount' => $request->amount, 'notes' => $request->notes, 'day_id' => $report->id]);
        $current = CurrentStat::first();
        $current->update(['availability' => $current->availability -= $expense->amount]);
        $report->expense += $expense->amount;
        $report->availability = $current->availability;
        $debt = $expense->expenseType->debt;
        if($debt != null) {
            $debt->amount -= $expense->amount;
            $debt->save();
            if($debt->amount <= 0) {
                $debt->delete();
            }
            $current->debt -= $expense->amount;
            $current->save();
        }
        $report->debt = $current->debt;
        $report->save();
        return back();   
    }

    public function removeExpense(Expense $expense)
    {
        $current = CurrentStat::first();
        $current->update(['availability' => $current->availability += $expense->amount]);
        $report = $expense->day;
        $report->expense -= $expense->amount;
        $report->availability = $current->availability;
        $expense->delete();
        $report->debt = $current->debt;
        $report->save();
        return back();  
    }
}

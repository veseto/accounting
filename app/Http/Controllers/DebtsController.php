<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;
use App\Models\CurrentStat;

class DebtsController extends Controller
{
    public function index()
    {
        $current = Debt::get();
        return view('debt.index', compact('current'));
    }

    public function addDebt(Request $request)
    {
        $debt = Debt::firstOrCreate(['expense_type_id' => $request->expense_type_id]);
        $debt->amount += $request->amount;
        $debt->save();
        $current = CurrentStat::first();
        $current->debt += $debt->amount;
        $current->save();
        return back();
    }

    public function removeDebt(Debt $debt)
    {
        $current = CurrentStat::first();
        $current->debt -= $debt->amount;
        $current->save();
        $debt->delete();
        return back();
    }
}

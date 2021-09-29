<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Day;

class ReportingController extends Controller
{
    public function protocols(Request $request)
    {
        if(!$request->has('from') && !$request->has('to') && !$request->has('type')) {
            return redirect($request->path()."?from=".Carbon::today()->subWeek()->format('Y-m-d')."&to=".Carbon::today()->format('Y-m-d')."&type=all");
        }

        $from = Carbon::create($request->from);
        $to = Carbon::create($request->to);
        $type = "all";

        $days = Day::whereDate('date', '>=', $from)->whereDate('date', '<=', $to)->get();

        return view('report.protocols', compact('days'));

    }
}

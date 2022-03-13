<?php

namespace App\Http\Controllers;

use App\OrderUpdateLog;
use Illuminate\Http\Request;
use App\Exports\OrderLogsExport;
use Excel;

class OrderUpdateLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date=$request->date;

        $logs=OrderUpdateLog::query();
        if($request->button == 'export'){

            return Excel::download(new OrderLogsExport($logs->latest()->get()), 'order_status_log.xlsx');
        }
        if($request->has('user_id') && $request->user_id!=null){

            $logs=$logs->where('user_id',$request->user_id);
        }
        if($date!=null){

            $logs=$logs->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));

        }

        $logs=$logs->paginate(13);
        $users=OrderUpdateLog::select('user_id')->distinct()->get();


        return view('backend.reports.order_update_logs',compact('logs','date','users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderUpdateLog  $orderUpdateLog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
// dd($request->order_id);
       $logs= OrderUpdateLog::where('order_id',$request->order_id)->get();
// dd($logs);
      return response([ 'modal_view' => view('backend.partials.event_sidebar',compact('logs'))->render()]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderUpdateLog  $orderUpdateLog
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderUpdateLog $orderUpdateLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderUpdateLog  $orderUpdateLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderUpdateLog $orderUpdateLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderUpdateLog  $orderUpdateLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderUpdateLog $orderUpdateLog)
    {
        //
    }
}

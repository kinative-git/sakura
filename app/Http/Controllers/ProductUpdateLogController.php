<?php

namespace App\Http\Controllers;

use App\ProductUpdateLog;
use Illuminate\Http\Request;
use App\Exports\ProductLogsExport;
use Excel;
class ProductUpdateLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date=$request->date;

        $logs=ProductUpdateLog::query();
        if($request->button == 'export'){
            return Excel::download(new ProductLogsExport($logs->latest()->get()), 'product_action_log.xlsx');
        }
        if($request->has('user_id') && $request->user_id!=null){

            $logs=$logs->where('user_id',$request->user_id);
        }
        if($date!=null){

            $logs=$logs->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));

        }

        $logs=$logs->paginate(13);
        $users=ProductUpdateLog::select('user_id')->distinct()->get();

        return view('backend.reports.product_action_log',compact('logs','date','users'));

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
     * @param  \App\ProductUpdateLog  $productUpdateLog
     * @return \Illuminate\Http\Response
     */
    public function show(ProductUpdateLog $productUpdateLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductUpdateLog  $productUpdateLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductUpdateLog $productUpdateLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductUpdateLog  $productUpdateLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductUpdateLog $productUpdateLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductUpdateLog  $productUpdateLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductUpdateLog $productUpdateLog)
    {
        //
    }
}

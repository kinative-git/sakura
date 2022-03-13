@extends('backend.layouts.app')

@section('content')
<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Order Status Log Report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('orderlog.index') }}" method="GET">
                    <div class="form-group row ">
                        <label class="col-md-2 col-form-label">{{translate('Sort by Staff')}} :</label>
                        <div class="col-md-3">
                            <select class="from-control aiz-selectpicker" name="user_id" class="text-center">
                              <option value="" class="text-center">--Select Staff --</option>

                              @foreach (App\User::whereIn('id',$users)->get() as $staff)
                                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                                <input type="text" class="aiz-date-range form-control" name="date" value="{{ $date }}" placeholder="Select Date" data-format="DD-MM-Y" data-separator=" to " data-advanced-range="true" autocomplete="off" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit">{{ translate('Filter') }}</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-light" type="submit" value="export" name="button">{{ translate('Export') }}</button>
                        </div>
                    </div>
                </form>

                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Order-Code') }}</th>
                            <th >{{ translate('Old Status') }}</th>
                            <th >{{ translate('Updated Status') }}</th>
                            <th >{{ translate('User') }}</th>
                            <td>{{  translate('Contact')  }}</td>
                            <th>{{ translate('Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $key => $log)
                            <tr>
                               @if($log->order)
                                <td>{{ $log->order->code }}</td>
                               @else
                                <td>Not Found</td>
                               @endif
                                <td>{{ $log->old_stat }}</td>
                                <td>{{ $log->new_stat }}</td>
                                <td>{{ $log->user->name }}</td>
                                @if($log->user->email)
                                <td>{{ $log->user->email }}</td>
                                @else
                                <td>{{ $log->user->phone }}</td>
                                @endif
                                <td>{{Carbon\Carbon::parse($log->created_at)->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination mt-4">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

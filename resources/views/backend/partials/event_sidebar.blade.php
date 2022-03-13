@foreach($logs as $key => $log)
<div class="container">
    <div class="row border-bottom">
        <div class="col p-2">
          <p> {{ $log->user->name }} Updated  Order Status to {{ $log->new_stat }}</p>
            at <span class="bg-primary rounded text-white p-1 m-1">{{Carbon\Carbon::parse($log->created_at)->format('d-m-Y') }}</span>


        </div>
        {{-- <div class="col-4 fs-9">
            <span class="badge badge-primary">
                {{  Carbon\Carbon::now()->diffInDays( Carbon\Carbon::parse($log->created_at), false)}}
            </span>days ago
        </div> --}}
        </div>
</div>
@endforeach

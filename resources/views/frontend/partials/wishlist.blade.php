<a href="{{ route('wishlists.index') }}" class="position-relative text-orange  d-none d-lg-block social">
    <img src="{{ static_asset('assets/img/wish.png') }}" class="mt-md-2" alt="">
    <span class="absolute-top-right " style="top: 3px;right: -5px;">
        @if(Auth::check())
            <span class="badge badge-inline badge-pill text-white shadow-md" style="width: 16px;height: 16px;font-size: 10px;background-color:red;">{{ count(Auth::user()->wishlists)}}</span>
        @else
            <span class="badge badge-inline badge-pill text-white shadow-md" style="width: 16px;height: 16px;font-size: 10px;background-color:red;">0</span>
        @endif
    </span>
</a>
-

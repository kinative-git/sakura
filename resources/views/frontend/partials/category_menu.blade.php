<div class="aiz-category-menu bg-white text-dark shadow-sm  @if(Route::currentRouteName() == 'home') shadow-sm" @else shadow-lg" id="category-sidebar" @endif>
    <div class="p-3 bg-primary d-none d-lg-block  all-category position-relative text-left">

        <a href="{{ route('categories.all') }}" class="text-reset text-light">
           <div class="d-flex align-items-center">
                <button class="aiz-mobile-toggler mx-2">
                    <span></span>
                </button> <span class="fw-600 fs-12 mr-3 text-uppercase">All categories</span>
           </div>
            {{-- <span class="d-none d-lg-inline-block">{{ translate('See All') }} ></span> --}}
        </a>
    </div>
   <div class="px-1  z-1000">
        <ul class="list-unstyled shadow-md categories no-scrollbar py-2 mb-0 text-left scroll-menue px-1 menutsat" >
            @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->take(11)->get() as $key => $category)
            @php
                $cat_name=$category->name;
            @endphp
                <li class="category-nav-element" data-id="{{ $category->id }}">
                    <a href="{{ route('products.category', $category->slug) }}" class="text-truncate text-reset py-2 px-3 d-block">
                        <img
                            class="cat-image lazyload mr-2 opacity-60"
                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="{{ uploaded_asset($category->icon) }}"
                            width="16"
                            alt="{{  $cat_name}}"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                        >
                        <span class="cat-name">{{ $cat_name }}</span>
                    </a>
                    {{-- make this part lazy load  --}}
                    @if(\App\Utility\CategoryUtility::get_immediate_children_count($category->id)>0)
                        <div class="sub-cat-menu c-scrollbar-light rounded shadow-lg p-4 cus-men" >
                            <div class="c-preloader text-center absolute-center">
                                <i class="las la-spinner la-spin la-3x opacity-70"></i>
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
   </div>
</div>





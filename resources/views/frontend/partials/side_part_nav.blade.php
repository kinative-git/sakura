
<div class="side-menu">
    <div class="side-menu-main c-scrollbar-light">
        <div class="p-3 fs-16 fw-700 d-flex justify-content-between align-items-center border-bottom">
            <span>Categories</span>
            <a href="{{ route('categories.all') }}" class="text-reset fs-11">See All</a>
        </div>
        <div class="p-3">
            @foreach (\App\Category::where('level', 0)->orderBy('name', 'asc')->get() as $key => $category)
                @php
                    $childs = \App\Utility\CategoryUtility::get_immediate_children_ids($category)
                @endphp
                @if(count($childs) > 0)
                   <div class="d-flex align-items-center">
                        <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="{{ route('products.category', $category->slug) }}">
                            {{  $category->name }}
                        </a>
                        <i class="las la-angle-right ml-auto"  data-id="{{ $category->id }}"></i>
                   </div>

                @else
                    <a class="text-reset py-2 fw-600 fs-13 d-block opacity-70 d-flex mb-2 justify-content-between" href="{{ route('products.category', $category->slug) }}">
                        {{  $category->name }}
                        <i class="las la-angle-right"></i>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
    <div class="sub-menu-wrap">
        @foreach (\App\Category::where('level', 0)->orderBy('name', 'asc')->get() as $key => $category)
            <div class="sub-menu c-scrollbar-light" id="cat-menu-{{ $category->id }}">
                <a href="javascript:void(0)" class="back-to-menu border-bottom d-block fs-16 fw-600 p-3 text-reset">
                    <i class="las la-angle-left"></i>
                    <span>Back to menu</span>
                </a>
                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                    <div class="mb-2">
                        @php
                            $cat_1=\App\Category::find($first_level_id);

                        @endphp
                        <a href="{{ route('products.category', $cat_1->slug) }}" class="text-reset d-block px-4 pt-3 pb-1 fw-800">{{ $cat_1->name }}</a>
                        @php
                            $childs = \App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id)
                        @endphp
                        @if(count($childs) > 0)
                            <ul class="list-unstyled ">
                                @foreach ($childs as $key => $second_level_id)
                                @php
                                    $cat_2=\App\Category::find($second_level_id);
                                @endphp
                                <li class="mb-2">
                                    <a class="text-reset d-block px-4 py-1 mt-2 fw-600 opacity-70" href="{{ route('products.category', $cat_2->slug) }}" >{{ $cat_2->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

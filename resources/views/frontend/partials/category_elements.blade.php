<div class="card-columns">
    @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
    @php
        $fst_cat=\App\Category::find($first_level_id);
    @endphp
        <div class="card shadow-none border-0">
            <ul class="list-unstyled mb-3">
                <li class="fw-600 border-bottom pb-2 mb-3">
                    <a class="text-reset" href="{{ route('products.category', $fst_cat->slug) }}">{{ $fst_cat->name }}</a>
                </li>
                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)
                @php
                    $scnd_lv_cat=\App\Category::find($second_level_id);
                @endphp
                    <li class="mb-2">
                        <a class="text-reset" href="{{ route('products.category', $scnd_lv_cat->slug) }}">{{ $scnd_lv_cat->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>

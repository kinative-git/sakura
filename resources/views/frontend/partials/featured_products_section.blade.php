@if(\App\Product::where('published', 1)->where('featured', '1')->count()>0)
<section class="mb-4">
    <div class="container">
        <div class=" py-4 shadow-sm ">
            <div class="d-flex flex-wrap mb-3 align-items-baseline  p-1 ">
                <h6 class="h6 fw-600 mb-0 fs-15 py-1 ff-c" >
                    <span class=" d-inline-block text-alter text-uppercase  ">featured products</span>
                </h6>

                <a href="{{ route('featured.products') }}" class="ml-auto mr-0 mt-2 mt-md-0 btn btn-primary btn-sm shadow-md text-uppercase">{{ translate('View All') }}</a>
            </div>
            <div class="row row-cols-lg-6 row-cols-md-6 row-cols-2 gutters-5"  >
                @foreach (filter_products(\App\Product::where('published', 1)->where('featured', '1'))->limit(12)->get() as $key => $product)
                <div class="col">
                    @include('frontend.partials.product_box_1',['product' => $product])
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@endif

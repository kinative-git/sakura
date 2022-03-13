 @if (get_setting('product_yours_categories') != null)
    @php $product_yours_categories = json_decode(get_setting('product_yours_categories')); @endphp
    <section class="mb-4 ">
        <div class="container-fluid ">
            <div class=" bg-white  shadow-sm">
                <div class="row justify-content-center d-flex flex-column justify-content-center align-items-center my-1">
                    <div class="col text-center text-cetner mb-3 mb-md-0 my-2 " >
                         <div class="py-4 d-flex align-items-center justify-content-center " style=" background-image: url({{ static_asset('assets/img/backicon.png') }}); background-repeat: no-repeat;
                         background-repeat: no-repeat;background-position: center;">
                             <h5 class="text text-uppercase opacity-80 pt-md-2 text-cetner fs-20 fw-700" style="letter-spacing:5px;">latest to the wodrobe</h5>
                         </div>
                    </div>
                </div>
                <div class="d-md-flex mb-3 justify-content-center px-3 py-4 align-items-center ">

                    <div class="mt-3 mt-md-0 d-none d-lg-block">
                        <ul class="list-inline nav d-block d-md-flex alig-items-center mobile-hor-swipe py-2" style="background-image: url('{{ static_asset('assets/img/hr_bg.png') }}');background-repeat: no-repeat;background-size: contain;">
                            <li class="list-inline-item">
                                <a class="fw-600 text-uppercase text-reset fs-15 p-2 d-inline-block active"  style="letter-spacing:3px " data-toggle="tab" href="#all-category">all products</a>
                            </li>
                            @foreach ( \App\Category::whereIn('id',$product_yours_categories)->get() as $key => $category)

                                @if ($category != null)
                                <li class="list-inline-item">
                                    <a class="fw-600 text-uppercase text-reset fs-15 p-2 d-inline-block" style="letter-spacing:3px " data-toggle="tab" href="#category-{{ $category->id }}">{{ $category->name }}</a>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-3 mt-md-0 d-lg-none">
                        <ul class="list-inline nav d-block d-md-flex alig-items-center mobile-hor-swipe py-2" style="background-image: url('{{ static_asset('assets/img/hr_mobile_bg.png') }}');background-repeat: no-repeat;background-size: contain;background-position: center;">
                            <li class="list-inline-item">
                                <a class="fw-600 text-uppercase text-reset fs-15 p-2 d-inline-block active"  style="letter-spacing:3px " data-toggle="tab" href="#all-category">all products</a>
                            </li>
                            @foreach ( \App\Category::whereIn('id',$product_yours_categories)->get() as $key => $category)

                                @if ($category != null)
                                <li class="list-inline-item">
                                    <a class="fw-600 text-uppercase text-reset fs-15 p-2 d-inline-block" style="letter-spacing:3px " data-toggle="tab" href="#category-{{ $category->id }}">{{ $category->name }}</a>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="tab-content px-3" style="min-height: 20rem;">
                    <div class="tab-pane fade show active" id="all-category" >
                        <div class="row row-cols-xxl-6 row-cols-lg-5 row-cols-md-5 row-cols-sm-3 row-cols-1 gutters-5">
                            @foreach (\App\Product::where('published', '1')->latest()->with('stocks')->limit(10)->get() as $key => $product)
                            <div class="col mb-2">
                                @include('frontend.partials.product_box_1',['product'=>$product])
                            </div>
                            @endforeach

                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-center  align-items-center  py-4 pb-5">
                                <a href="{{ route('search') }}" class="btn btn-primary px-4 text-uppercase btn-lg px-5 fs-13" style="letter-spacing: 2px">{{ translate('view all') }}</a>
                            </div>
                        </div>
                    </div>
                    @foreach ($product_yours_categories as $key => $value)
                        @php $category = \App\Category::find($value); @endphp
                        @if ($category != null)
                            <div class="tab-pane fade" id="category-{{ $category->id }}" >
                                <div class="row row-cols-xl-6 row-cols-lg-5 row-cols-md-4 row-cols-sm-3 row-cols-1 gutters-5">
                                    @foreach (get_cached_products( $category->id) as $key => $product)
                                    <div class="col mb-2">
                                        @include('frontend.partials.product_box_1',['product'=>$product])
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col d-flex justify-content-center  align-items-center  py-4 pb-5">
                                        <a href="{{ route('products.category', $category->slug) }}" class="btn btn-primary btn-lg px-5 text-uppercase fs-13" style="letter-spacing: 2px">{{ translate('view all') }}</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

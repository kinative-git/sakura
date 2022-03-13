@extends('backend.layouts.app')

@section('content')
  <link rel="stylesheet" href="{{ static_asset('assets/css/style.min.css') }}">
{{-- @if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
    <div class="">
        <div class="alert alert-danger d-flex align-items-center">
            {{translate('Please Configure SMTP Setting to work all email sending functionality')}},
            <a class="alert-link ml-2" href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>
        </div>
    </div>
@endif --}}
@if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
    <div class="row  row-cols-lg-4 row-cols-md-4 row-cols-1 gutters-10 my-3 mb-4">
        <div class="col my-1  ">
            <a class="text-dark" href="{{ route('products.create') }}">
                <div class="p-2 bg-white rounded hov-shadow-md">
                    <div class="p-1 d-flex align-items-center">
                        <div class="d-flex justify-content-center align-items-center rounded p-2 mr-1 text-white" style="background-color: #3498db;">
                            <i class="las la-plus-square fs-44"></i>
                        </div>
                        <div class=" px-2 ">
                          <div class="d-flex flex-column justify-content-between align-items-left">
                           <div class="pb-2 fs-14 fw-500">Add New Product</div>
                           <div class="fs-15 opacity-90">{{ App\Product::count() }}</div>
                          </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
        <div class="col my-1 ">
            <a class="text-dark"  @if(Auth::user()->user_type=='admin') href="{{ route('poin-of-sales.index') }}" @elseif(Auth::user()->user_type =='seller')href="{{ route('poin-of-sales.seller_index') }}" @else @endif>
                <div class="p-2 bg-white rounded  hov-shadow-md">
                    <div class="p-1 d-flex align-items-center">
                        <div class="d-flex justify-content-center align-items-center rounded p-2 mr-1 text-white" style="background-color: #e74c3c;">
                            <i class="las la-shopping-cart fs-44"></i>
                        </div>
                        <div class=" px-2 ">
                          <div class="d-flex flex-column justify-content-center align-items-left" >
                            <div class="pb-2 fs-14 fw-500">Add Sales</div>
                           <div class="fs-15 opacity-90">{{\App\Order::all()->sum('grand_total')  }}</div>
                          </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
        <div class="col my-1 ">
            <div class="p-2 bg-white rounded  hov-shadow-md">
                <a  class="text-dark" href="{{ route('all_orders.index') }}">
                    <div class="p-1 d-flex align-items-center">
                        <div class="d-flex justify-content-center align-items-center rounded p-2 mr-1 text-white" style="background-color: #00bc8c;">
                            <i class="las la-chalkboard fs-44"></i>
                        </div>
                        <div class=" px-2 ">
                          <div class="d-flex flex-column justify-content-center align-items-left">
                            <div class="pb-2 fs-14 fw-500">Recent Orders</div>
                           <div class="fs-15 opacity-90">{{ App\Order::count() }}</div>
                          </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
        <div class="col my-1 ">
            <a  class="text-dark"  href="{{ route('orderlog.index') }}">
                <div class="p-2 bg-white rounded  hov-shadow-md">
                    <div class="p-1 d-flex align-items-center">
                        <div class="d-flex justify-content-center align-items-center rounded p-2 mr-1 text-white" style="background-color: #f39c12;">
                            <i class="las la-clipboard fs-44"></i>
                        </div>
                        <div class=" px-2 ">
                          <div class="d-flex flex-column justify-content-center align-items-left">
                            <div class="pb-2 fs-14 fw-500">Event Logs</div>
                           <div class="fs-15 opacity-90">{{ App\OrderUpdateLog::count() }}</div>
                          </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>


{{-- new stats section  --}}



    <div class="row justify-content-between ">
        <div class="col-lg-4 col-md-12  ">
          <a class="text-dark" href="{{ route('all_orders.index') }}">
            <div class="white-box analytics-info hov-shadow-md">
                <h3 class="box-title">Total Sales</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                  <li>
                    <div id="sparklinedash">
                      <canvas
                        width="67"
                        height="30"
                        style="
                          display: inline-block;
                          width: 67px;
                          height: 30px;
                          vertical-align: top;
                        "
                      ></canvas>
                    </div>
                  </li>
                  <li class="ms-auto">
                    <span class="counter text-success">{{\App\Order::all()->sum('grand_total')  }}</span>
                  </li>
                </ul>
              </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-12  ">
            <a class="text-dark" href="{{ route('all_orders.index') }}">
            <div class="white-box analytics-info hov-shadow-md">
                <h3 class="box-title">Today Sales</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                  <li>
                    <div id="sparklinedash2">
                      <canvas
                        width="67"
                        height="30"
                        style="
                          display: inline-block;
                          width: 67px;
                          height: 30px;
                          vertical-align: top;
                        "
                      ></canvas>
                    </div>
                  </li>
                  <li class="ms-auto">
                      @php
                            $today_date = date('Y-m-d');
                      @endphp
                    <span class="counter text-purple">{{ \App\Order::where('created_at','like',"%$today_date%")->sum('grand_total') }}</span>
                  </li>
                </ul>
              </div>
         </a>
        </div>
        <div class="col-lg-4 col-md-12 ">
        <a class="text-dark" href="{{ route('all_orders.index') }}">
            <div class="white-box analytics-info  hov-shadow-md">
                <h3 class="box-title">Total Orders</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                  <li>
                    <div id="sparklinedash3">
                      <canvas
                        width="67"
                        height="30"
                        style="
                          display: inline-block;
                          width: 67px;
                          height: 30px;
                          vertical-align: top;
                        "
                      ></canvas>
                    </div>
                  </li>
                  <li class="ms-auto">
                    <span class="counter text-info">{{ App\Order::count() }}</span>
                  </li>
                </ul>
              </div>
          </a>
        </div>
    </div>
    <div class="row justify-content-between ">
        <div class="col-lg-4 col-md-12">
            <a class="text-dark" href="{{ route('products.all') }}">
            <div class="white-box analytics-info  hov-shadow-md">
                <h3 class="box-title">Total Products</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                  <li>
                    <div id="sparklinedash4" class="p-2" >
                      <canvas
                        width="67"
                        height="30"
                        style="
                          display: inline-block;
                          width: 67px;
                          height: 30px;
                          vertical-align: top;
                        "
                      ></canvas>
                    </div>
                  </li>
                  <li class="ms-auto">
                    <span class="counter text-success">{{ App\Product::count() }}</span>
                  </li>
                </ul>
              </div>
         </a>
        </div>
        <div class="col-lg-4 col-md-12  ">
            <a class="text-dark" href="{{ route('sellers.index') }}">
            <div class="white-box analytics-info hov-shadow-md">
                <h3 class="box-title">Total Sellers</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                  <li>
                   <div class="d-flex justify-content-center align-items-center text-white p-4" style="background-color: #f7aa2e; width:67px;
                   height:30px;">
                    <i class="las la-user-friends fs-44 "></i>
                   </div>
                  </li>
                  <li class="ms-auto">
                    <span class="counter " style="color: #f19f1c;">{{ App\Seller::count() }}</span>
                  </li>
                </ul>
              </div>
         </a>
        </div>

        <div class="col-lg-4 col-md-12 ">
            <a class="text-dark" href="{{ route('sale_report.index') }}">
            <div class="white-box analytics-info  hov-shadow-md">
                <h3 class="box-title">Total Items Purchased</h3>
                <ul class="list-inline two-part d-flex align-items-center mb-0">
                  <li>
                    <div class="d-flex justify-content-center align-items-center text-white p-4" style=" width:67px;
                    height:30px;background-color: #00bc8c;"><i class="las la-dolly fs-42"></i></div>
                  </li>
                  <li class="ms-auto">
                    <span class="counter  " style="color: #07a37c;">{{ App\ProductStock::all()->sum('qty_sold') }}</span>
                  </li>
                </ul>
              </div>
         </a>
        </div>
    </div>


{{-- new stats section end  --}}


    {{-- old stats section  --}}
{{-- <div class="row gutters-10">

    <div class="col-lg-6">
        <div class="row gutters-10">
            <div class="col-6">
                <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Customer') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\Customer::all()->count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-6">
                <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Order') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\Order::all()->count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-6">
                <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Product category') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\Category::all()->count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
            <div class="col-6">
                <div class="bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">
                    <div class="px-3 pt-3">
                        <div class="opacity-50">
                            <span class="fs-12 d-block">{{ translate('Total') }}</span>
                            {{ translate('Product brand') }}
                        </div>
                        <div class="h3 fw-700 mb-3">{{ \App\Brand::all()->count() }}</div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row gutters-10">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 fs-14">{{ translate('Products') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="pie-1" class="w-100" height="305"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 fs-14">{{ translate('Sellers') }}</h6>
                    </div>
                    <div class="card-body">
                        <canvas id="pie-2" class="w-100" height="305"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endif


@if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
    <div class="row gutters-10">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fs-14">{{ translate('Category wise product sale') }}</h6>
                </div>
                <div class="card-body">
                    <canvas id="graph-1" class="w-100" height="500"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fs-14">{{ translate('Category wise product stock') }}</h6>
                </div>
                <div class="card-body">
                    <canvas id="graph-2" class="w-100" height="500"></canvas>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- <div class="card">
    <div class="card-header">
        <h6 class="mb-0">{{ translate('Top 12 Products') }}</h6>
    </div>
    <div class="card-body">
        <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4" data-md-items="3" data-sm-items="2" data-arrows='true'>
            @foreach (filter_products(\App\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(12)->get() as $key => $product)
                <div class="carousel-box">
                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">
                        <div class="position-relative">
                            <a href="{{ route('product', $product->slug) }}" class="d-block">
                                <img
                                    class="img-fit lazyload mx-auto h-210px"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                    alt="{{  $product->getTranslation('name')  }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                            </a>
                        </div>
                        <div class="p-md-3 p-2 text-left">
                            <div class="fs-15">
                                @if(home_base_price($product) != home_discounted_base_price($product))
                                    <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product) }}</del>
                                @endif
                                <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>
                            </div>
                            <div class="rating rating-sm mt-1">
                                {{ renderStarRating($product->rating) }}
                            </div>
                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">
                                <a href="{{ route('product', $product->slug) }}" class="d-block text-reset">{{ $product->getTranslation('name') }}</a>
                            </h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-12">
        <div class="card">
           <div class="text-right">
            <a  href="javascript:void(0)" onclick="print_invoice('{{ route('sale_report.print') }}')" class="btn btn-soft-primary btn-icon btn-circle btn-lg my-2 mx-2"><i class="las la-print"></i></a>
           </div>
           <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Order Code</th>
                            <th scope="col">Product</th>
                            <th scope="col">Variant</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Shipping</th>
                            <th scope="col">Date</th>

                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $orders=App\Order::latest()->limit(12)->get();
                            @endphp
                            @foreach ($orders as $key=>$order)
                                @foreach ($order->orderDetails as $orderDetail)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                            <td><a href="{{ route('all_orders.show', encrypt($order->id)) }}">{{ $order->code }}</a></td>
                                            <td style="width: 300px;">
                                                @if ($orderDetail->product != null)
                                                    {{ $orderDetail->product->name }}
                                                @endif
                                            </td>
                                            <td>{{ $orderDetail->variation }}</td>
                                            <td>{{ $orderDetail->quantity }}</td>
                                            <td>{{ $orderDetail->price }}</td>

                                            <td>{{ $orderDetail->shipping_cost }}</td>


                                            <td>{{ Carbon\Carbon::parse($orderDetail->created_at)->format('d-m-Y ') }}</td>

                                        </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
           </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    AIZ.plugins.chart('#pie-1',{
        type: 'doughnut',
        data: {
            labels: [
                '{{translate('Total published products')}}',
                '{{translate('Total sellers products')}}',
                '{{translate('Total admin products')}}'
            ],
            datasets: [
                {
                    data: [
                        {{ \App\Product::where('published', 1)->get()->count() }},
                        {{ \App\Product::where('published', 1)->where('added_by', 'seller')->get()->count() }},
                        {{ \App\Product::where('published', 1)->where('added_by', 'admin')->get()->count() }}
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }
            ]
        },
        options: {
            cutoutPercentage: 70,
            legend: {
                labels: {
                    fontFamily: 'Poppins',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
                position: 'bottom'
            }
        }
    });

    AIZ.plugins.chart('#pie-2',{
        type: 'doughnut',
        data: {
            labels: [
                '{{translate('Total sellers')}}',
                '{{translate('Total approved sellers')}}',
                '{{translate('Total pending sellers')}}'
            ],
            datasets: [
                {
                    data: [
                        {{ \App\Seller::all()->count() }},
                        {{ \App\Seller::where('verification_status', 1)->get()->count() }},
                        {{ \App\Seller::where('verification_status', 0)->count() }}
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }
            ]
        },
        options: {
            cutoutPercentage: 70,
            legend: {
                labels: {
                    fontFamily: 'Montserrat',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
                position: 'bottom'
            }
        }
    });
    var sfs = {
            labels: [
                @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach
            ],
            datasets: [
                @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                {{ \App\Product::where('category_id', $category->id)->sum('num_of_sale') }},
                @endforeach
            ]
    }
    AIZ.plugins.chart('#graph-1',{
        type: 'bar',
        data: {
            labels: [
                @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach
            ],
            datasets: [{
                label: '{{ translate('Number of sale') }}',
                data: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        @php
                            $category_ids = \App\Utility\CategoryUtility::children_ids($category->id);
                            $category_ids[] = $category->id;
                        @endphp
                    {{ \App\Product::whereIn('category_id', $category_ids)->sum('num_of_sale') }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        'rgba(55, 125, 255, 0.4)',
                    @endforeach
                ],
                borderColor: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        'rgba(55, 125, 255, 1)',
                    @endforeach
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: '#f2f3f8',
                        zeroLineColor: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10
                    }
                }]
            },
            legend:{
                labels: {
                    fontFamily: 'Poppins',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
            }
        }
    });
    AIZ.plugins.chart('#graph-2',{
        type: 'bar',
        data: {
            labels: [
                @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach
            ],
            datasets: [{
                label: '{{ translate('Number of Stock') }}',
                data: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        @php
                            $category_ids = \App\Utility\CategoryUtility::children_ids($category->id);
                            $category_ids[] = $category->id;

                            $products = \App\Product::whereIn('category_id', $category_ids)->get();
                            $qty = 0;
                            foreach ($products as $key => $product) {

                                foreach ($product->stocks as $key => $stock) {
                                    $qty += $stock->qty;
                                }


                            }
                        @endphp
                        {{ $qty }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        'rgba(253, 57, 149, 0.4)',
                    @endforeach
                ],
                borderColor: [
                    @foreach (\App\Category::where('level', 0)->get() as $key => $category)
                        'rgba(253, 57, 149, 1)',
                    @endforeach
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: '#f2f3f8',
                        zeroLineColor: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10
                    }
                }]
            },
            legend:{
                labels: {
                    fontFamily: 'Poppins',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
            }
        }
    });
</script>
@endsection

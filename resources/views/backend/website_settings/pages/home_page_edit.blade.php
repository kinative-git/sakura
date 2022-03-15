@extends('backend.layouts.app')
@section('content')

<h6 class="fw-600 mb-4">{{ translate('Home Page Settings') }}</h6>
<ul class="nav nav-tabs nav-fill border-light">
    @foreach (\App\Language::all() as $key => $language)
        <li class="nav-item">
            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('custom-pages.edit', ['id'=>$page->slug, 'lang'=> $language->code,'page'=>'home'] ) }}">
                <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                <span>{{$language->name}}</span>
            </a>
        </li>
    @endforeach
</ul>
<div class="">
	<div class="">
		{{-- Home Slider --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Home Slider') }}</h6>
			</div>
			<div class="card-body">
				<div class="alert alert-info">
					{{ translate('We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.') }}
				</div>
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Photos & Links') }}</label>
						<div class="home-slider-target">
							<input type="hidden" name="types[]" value="home_slider_images">
							<input type="hidden" name="types[]" value="home_slider_links">
							@if (get_setting('home_slider_images') != null)
								@foreach (json_decode(get_setting('home_slider_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="home_slider_images">
					                                <input type="hidden" name="home_slider_images[]" class="selected-files" value="{{ json_decode(get_setting('home_slider_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_slider_links">
												<input type="text" class="form-control" placeholder="http://" name="home_slider_links[]" value="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
											</div>
										</div>
										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='
							<div class="row gutters-5">
								<div class="col-md-4">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
											</div>
											<div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="types[]" value="home_slider_images">
											<input type="hidden" name="home_slider_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_slider_links">
										<input type="text" class="form-control" placeholder="http://" name="home_slider_links[]">
									</div>
								</div>
								<div class="col-md-auto">
									<div class="form-group">
										<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
											<i class="las la-times"></i>
										</button>
									</div>
								</div>
							</div>'
							data-target=".home-slider-target">
							{{ translate('Add New') }}
						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
        <div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('About us') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
	                <div class="form-group row">
						<label class="col-md-3 col-from-label">{{translate('Title')}}</label>
						<div class="col-md-8">
							<div class="form-group">
								<input type="hidden" name="types[][{{ $lang }}]" value="home_about_title">
								<input type="text" class="form-control" placeholder="" name="home_about_title" value="{{ get_setting('home_about_title', null, $lang) }}">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-from-label">{{translate('whoe we are learn more link')}}</label>
						<div class="col-md-8">
							<div class="form-group">
								<input type="hidden" name="types[][{{ $lang }}]" value="home_about_link">
								<input type="text" class="form-control" placeholder="" name="home_about_link" value="{{ get_setting('home_about_link', null, $lang) }}">
							</div>
						</div>
					</div>
                    <div class="form-group">
                        <label>{{ translate('About description') }}</label>
                        <input type="hidden" name="types[][{{ $lang }}]" value="home_about">
                        <textarea class="aiz-text-editor form-control" name="home_about" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">
                            @php echo get_setting('home_about', null, $lang); @endphp
                        </textarea>
                    </div>

                    <label>{{ translate('About Image') }}</label>
					<div class="home-about-target">
						<input type="hidden" name="types[]" value="home_about_image">
						{{-- @if (get_setting('home_about_image') != null) --}}

								<div class="row gutters-5">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group" data-toggle="aizuploader" data-type="image">
				                                <div class="input-group-prepend">
				                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
				                                </div>
				                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
				                                <input type="hidden" name="home_about_image" class="selected-files" value="{{ json_decode(get_setting('home_about_image'), true) }}">
				                            </div>
				                            <div class="file-preview box sm">
				                            </div>
			                            </div>
									</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="types[]" value="home_about_link">
												<input type="text" class="form-control" placeholder="http://" name="home_about_link" value="{{ json_decode(get_setting('home_about_link'), true) }}">
                                        </div>
                                    </div>

								</div>
                        {{-- @endif --}}

					</div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>

        <div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Bottom Banner') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
                    <label>{{ translate('About Image') }}</label>
					<div class="home-about-target">
						<input type="hidden" name="types[]" value="bottom_banner">
						{{-- @if (get_setting('bottom_banner') != null) --}}

								<div class="row gutters-5">
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group" data-toggle="aizuploader" data-type="image">
				                                <div class="input-group-prepend">
				                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
				                                </div>
				                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
				                                <input type="hidden" name="bottom_banner" class="selected-files" value="{{ json_decode(get_setting('bottom_banner'), true) }}">
				                            </div>
				                            <div class="file-preview box sm">
				                            </div>
			                            </div>
									</div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="hidden" name="types[]" value="bottom_banner_link">
												<input type="text" class="form-control" placeholder="http://" name="bottom_banner_link" value="{{ json_decode(get_setting('bottom_banner_link'), true) }}">
                                        </div>
                                    </div>

								</div>
                        {{-- @endif --}}

					</div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>

		{{-- category wise product filter --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Category wise product filter') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
                    <div class="form-group row">
						<label class="col-md-2 col-from-label">{{translate('Select category (Max 6)')}}</label>
						<div class="col-md-10">
							<input type="hidden" name="types[]" value="filter_categories">
							<select name="filter_categories[]" class="form-control aiz-selectpicker" multiple data-max-options="6" data-live-search="true" data-selected={{ get_setting('filter_categories') }} >
								@foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
									<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
									@foreach ($category->childrenCategories as $childCategory)
										@include('categories.child_category', ['child_category' => $childCategory])
									@endforeach
								@endforeach
							</select>
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
        {{-- main slider under category section --}}
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Main Slider Under Category') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">

                        <br>
                        <label class="col-md-2 col-from-label">{{translate('Categories (Max 10)')}}</label>
                        <div class="col-md-10">
                            <input type="hidden" name="types[]" value="banner_under_cat">
                            <select name="banner_under_cat[]" class="form-control aiz-selectpicker" multiple data-live-search="true" data-max-options="16" data-selected={{ get_setting('banner_under_cat') }} required>
                                @foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                    @foreach ($category->childrenCategories as $childCategory)
                                        @include('categories.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
         {{-- main slider under category section --}}
         <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Stativ features Under Category') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">

                        <br>
                        <label class="col-md-2 col-from-label">{{translate('Categories (Max 6)')}}</label>
                        <div class="col-md-10">
                            <input type="hidden" name="types[]" value="banner_under_cat2">
                            <select name="banner_under_cat2[]" class="form-control aiz-selectpicker" multiple data-live-search="true" data-max-options="16" data-selected={{ get_setting('banner_under_cat') }} required>
                                @foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                    @foreach ($category->childrenCategories as $childCategory)
                                        @include('categories.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
         {{-- featuired for you  category section --}}
         <div class="card">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Featured For you ') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">

                        <br>
                        <label class="col-md-2 col-from-label">{{translate('Categories (Max 5)')}}</label>
                        <div class="col-md-10">
                            <input type="hidden" name="types[]" value="product_yours_categories">
                            <select name="product_yours_categories[]" class="form-control aiz-selectpicker" multiple data-live-search="true" data-max-options="16" data-selected={{ get_setting('product_yours_categories') }} required>
                                @foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
                                    @foreach ($category->childrenCategories as $childCategory)
                                        @include('categories.child_category', ['child_category' => $childCategory])
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- banner 1 --}}
        <div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Banner (Max 2)') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Banner & Links') }}</label>
						<div class="home-banner1-target">
							<input type="hidden" name="types[]" value="home_banner1_images">
							<input type="hidden" name="types[]" value="home_banner1_links">
                            <input type="hidden" name="types[]" value="home_banner1_text">
							@if (get_setting('home_banner1_images') != null)
								@foreach (json_decode(get_setting('home_banner1_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-5">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="home_banner1_images">
					                                <input type="hidden" name="home_banner1_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner1_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner1_links">
												<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]" value="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}">
											</div>
										</div>
                                        <div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner1_links">
												<input type="text" class="form-control" placeholder="text" name="home_banner1_text[]" value="{{ json_decode(get_setting('home_banner1_text'), true)[$key] }}">
											</div>
										</div>
										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='
							<div class="row gutters-5">
								<div class="col-md-5">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
											</div>
											<div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="types[]" value="home_banner1_images">
											<input type="hidden" name="home_banner1_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner1_links">
										<input type="text" class="form-control" placeholder="http://" name="home_banner1_links[]">
									</div>
								</div>
                                <div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner1_links">
										<input type="text" class="form-control" placeholder="http://" name="home_banner1_text[]">
									</div>
								</div>
								<div class="col-md-auto">
									<div class="form-group">
										<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
											<i class="las la-times"></i>
										</button>
									</div>
								</div>
							</div>'
							data-target=".home-banner1-target">
							{{ translate('Add New') }}
						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
		{{-- Home Banner 2 --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Banner (Max 6)') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>{{ translate('Banner & Links') }}</label>
						<div class="home-banner2-target">
							<input type="hidden" name="types[]" value="home_banner2_images">
							<input type="hidden" name="types[]" value="home_banner2_links">
                            <input type="hidden" name="types[]" value="home_banner2_text">
							@if (get_setting('home_banner2_images') != null)
								@foreach (json_decode(get_setting('home_banner2_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-5">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="home_banner2_images">
					                                <input type="hidden" name="home_banner2_images[]" class="selected-files" value="{{ json_decode(get_setting('home_banner2_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner2_links">
												<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]" value="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}">
											</div>
										</div>
                                        <div class="col-md">
											<div class="form-group">
												<input type="hidden" name="types[]" value="home_banner2_text">
												<input type="text" class="form-control" placeholder="http://" name="home_banner2_text[]" value="{{ json_decode(get_setting('home_banner2_text'), true)[$key] }}">
											</div>
										</div>
										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='
							<div class="row gutters-5">
								<div class="col-md-5">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
											</div>
											<div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="types[]" value="home_banner2_images">
											<input type="hidden" name="home_banner2_images[]" class="selected-files">
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner2_links">
										<input type="text" class="form-control" placeholder="http://" name="home_banner2_links[]">
									</div>
								</div>
                                <div class="col-md">
									<div class="form-group">
										<input type="hidden" name="types[]" value="home_banner2_text">
										<input type="text" class="form-control" placeholder="http://" name="home_banner2_text[]">
									</div>
								</div>
								<div class="col-md-auto">
									<div class="form-group">
										<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
											<i class="las la-times"></i>
										</button>
									</div>
								</div>
							</div>'
							data-target=".home-banner2-target">
							{{ translate('Add New') }}
						</button>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>


		{{-- Top 10 --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Top Brands &') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					{{-- <div class="form-group row">
						<label class="col-md-2 col-from-label">{{translate('Categories')}}</label>
						<div class="col-md-10">
							<input type="hidden" name="types[]" value="top10_categories">
							<select name="top10_categories[]" class="form-control aiz-selectpicker" multiple data-live-search="true" data-selected="{{ get_setting('top10_categories') }}">
								@foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->get() as $category)
									<option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
									@foreach ($category->childrenCategories as $childCategory)
										@include('categories.child_category', ['child_category' => $childCategory])
									@endforeach
								@endforeach
							</select>
						</div>
					</div> --}}
					<div class="form-group row">
						<label class="col-md-2 col-from-label">{{translate('Brands (Max 10)')}}</label>
						<div class="col-md-10">
							<input type="hidden" name="types[]" value="top10_brands">
							<select name="top10_brands[]" class="form-control aiz-selectpicker" multiple data-live-search="true" data-selected="{{ get_setting('top10_brands') }}">
								@foreach (\App\Brand::all() as $key => $brand)
									<option value="{{ $brand->id }}">{{ $brand->getTranslation('name') }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>

        {{-- icons qith text  --}}
        <div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Icon texts') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf

					<div class="form-group">
						<label>{{ translate('Authentic icons and texts') }}</label>
						<div class="brands-target">
							<input type="hidden" name="types[]" value="authentic_images">
							<input type="hidden" name="types[]" value="authetic_names">
							<input type="hidden" name="types[]" value="authetic_desc">


							@if (get_setting('authentic_images') != null)
                            {{-- {{ dd(json_decode(get_setting('authentic_images'), true)) }} --}}
								@foreach (json_decode(get_setting('authentic_images'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-lg-6">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
					                                <input type="hidden" name="authentic_images[]" class="selected-files" value="{{ json_decode(get_setting('authentic_images'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-lg">
                                            {{-- {{ dd(json_decode(get_setting('authetic_names'), true)) }} --}}
											<div class="form-group">
												<input type="text" class="form-control" placeholder="{{ translate('Text') }}" name="authetic_names[]" @if(json_decode(get_setting('authetic_names'), true) !=null) value="{{ json_decode(get_setting('authetic_names'), true)[$key] }}"@endif>
											</div>
										</div>
                                        <div class="col-lg">
                                            {{-- {{ dd(json_decode(get_setting('authetic_names'), true)) }} --}}
											<div class="form-group">
												<input type="text" class="form-control" placeholder="{{ translate('Text') }}" name="authetic_desc[]" @if(json_decode(get_setting('authetic_desc'), true) !=null) value="{{ json_decode(get_setting('authetic_names'), true)[$key] }}"@endif>
											</div>
										</div>

										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>
								@endforeach
							@endif
						</div>

						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='
							<div class="row gutters-5">
								<div class="col-lg-6">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
			                                <div class="input-group-prepend">
			                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
			                                </div>
			                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
			                                <input type="hidden" name="authentic_images[]" class="selected-files" >
			                            </div>
			                            <div class="file-preview box sm">
			                            </div>
		                            </div>
								</div>
								<div class="col-lg">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="{{ translate('Text') }}" name="authetic_names[]" >
									</div>
								</div>
                                <div class="col-lg">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="{{ translate('Text') }}" name="authetic_desc[]" >
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
							data-target=".brands-target">
							{{ translate('Add New') }}
						</button>
					</div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
        	{{-- Featured shops --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Featured shops') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
						<label class="col-md-2 col-from-label">{{translate('Select Shops')}}</label>
						<div class="col-md-10">
							<input type="hidden" name="types[]" value="featured_shops">
							<select name="featured_shops[]" class="form-control aiz-selectpicker" multiple data-live-search="true" data-selected="{{ get_setting('featured_shops') }}" >
								@foreach (\App\Seller::where('verification_status', 1)->get() as $key => $seller)
								@if($seller->user != null && $seller->user->shop != null){
									<option value="{{ $seller->user->shop->id }}">{{ $seller->user->shop->name }}</option>
								@endif
								@endforeach
							</select>
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
        <div class="card ">
            <div class="card-header">
                <h6 class="mb-0">{{ translate('Promo Branding') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>{{ translate('Promo Text') }}</label>
                        <input type="hidden" name="types[]" value="promo_text">
                        <input type="text" class="form-control" placeholder="{{ translate('text') }}" name="promo_text" value="{{ get_setting('promo_text') }}">
                    </div>
                    <div class="form-group">
                        <label>{{ translate('Promo Video URL') }}</label>
                        <input type="hidden" name="types[]" value="promo_video">
                        <input type="text" class="form-control" placeholder="{{ translate('link') }}" name="promo_video" value="{{ get_setting('promo_video') }}">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
           {{-- Customer review --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Customer review') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf

					<div class="form-group">
						<label>{{ translate('Reviews') }}</label>
						<div class="customer-review-target">
							<input type="hidden" name="types[]" value="customer_reviews_image">
							<input type="hidden" name="types[]" value="customer_reviews_name">
							<input type="hidden" name="types[]" value="customer_reviews_title">
							<input type="hidden" name="types[]" value="customer_reviews_details">
							@if (get_setting('customer_reviews_image') != null)
								@foreach (json_decode(get_setting('customer_reviews_image'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-lg-3">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="customer_reviews_image">
					                                <input type="hidden" name="customer_reviews_image[]" class="selected-files" value="{{ json_decode(get_setting('customer_reviews_image'), true)[$key] }}">
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="hidden" name="types[]" value="customer_reviews_name">
												<input type="text" class="form-control" placeholder="{{ translate('Name') }}" name="customer_reviews_name[]" value="{{ json_decode(get_setting('customer_reviews_name'), true)[$key] }}">
											</div>
										</div>
										<div class="col-lg-2">
											<div class="form-group">
												<input type="hidden" name="types[]" value="customer_reviews_title">
												<input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="customer_reviews_title[]" value="{{ json_decode(get_setting('customer_reviews_title'), true)[$key] }}">
											</div>
										</div>
										<div class="col-lg">
											<div class="form-group">
												<input type="hidden" name="types[]" value="customer_reviews_details">
												<input type="text" class="form-control" placeholder="{{ translate('Details') }}" name="customer_reviews_details[]" value="{{ json_decode(get_setting('customer_reviews_details'), true)[$key] }}">
											</div>
										</div>
										<div class="col-auto">
											<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
												<i class="las la-times"></i>
											</button>
										</div>
									</div>
								@endforeach
							@endif
						</div>

						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='
							<div class="row gutters-5">
								<div class="col-lg-3">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
			                                <div class="input-group-prepend">
			                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
			                                </div>
			                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="types[]" value="customer_reviews_image">
			                                <input type="hidden" name="customer_reviews_image[]" class="selected-files" >
			                            </div>
			                            <div class="file-preview box sm">
			                            </div>
		                            </div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<input type="hidden" name="types[]" value="customer_reviews_name">
										<input type="text" class="form-control" placeholder="{{ translate('Title') }}" name="customer_reviews_name[]" >
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group">
										<input type="hidden" name="types[]" value="customer_reviews_title">
										<input type="text" class="form-control" placeholder="{{ translate('Subtitle') }}" name="customer_reviews_title[]" >
									</div>
								</div>
								<div class="col-lg">
									<div class="form-group">
										<input type="hidden" name="types[]" value="customer_reviews_details">
										<input type="text" class="form-control" placeholder="{{ translate('Details') }}" name="customer_reviews_details[]" >
									</div>
								</div>
								<div class="col-auto">
									<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
										<i class="las la-times"></i>
									</button>
								</div>
							</div>'
							data-target=".customer-review-target">
							{{ translate('Add New') }}
						</button>
					</div>

					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
        	{{-- Top 10 --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Corporate clients') }}</h6>
			</div>
			<div class="card-body">
				<form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
					@csrf
	                <div class="form-group row">
						<label class="col-md-3 col-from-label">{{translate('Title')}}</label>
						<div class="col-md-8">
							<div class="form-group">
								<input type="hidden" name="types[][{{ $lang }}]" value="corporate_client_title">
								<input type="text" class="form-control" placeholder="" name="corporate_client_title" value="{{ get_setting('corporate_client_title', null, $lang) }}">
							</div>
						</div>
					</div>
	                <div class="form-group row">
						<label class="col-md-3 col-from-label">{{translate('Sub title')}}</label>
						<div class="col-md-8">
							<div class="form-group">
								<input type="hidden" name="types[][{{ $lang }}]" value="corporate_client_subtitle">
								<input type="text" class="form-control" placeholder="" name="corporate_client_subtitle" value="{{ get_setting('corporate_client_subtitle', null, $lang) }}">
							</div>
						</div>
					</div>
					<div class="corporate-client-target">
						<input type="hidden" name="types[]" value="corporate_clients">
						<div class="form-group">
							<div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple='true'>
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="corporate_clients" class="selected-files" value="{{ get_setting('corporate_clients') }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
		$(document).ready(function(){
		    AIZ.plugins.bootstrapSelect('refresh');
		});
    </script>
@endsection

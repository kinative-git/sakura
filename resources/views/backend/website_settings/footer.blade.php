@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="h3">{{ translate('Website Footer') }}</h1>
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs nav-fill border-light">
        @foreach (\App\Language::all() as $key => $language)
            <li class="nav-item">
                <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('website.footer', ['lang'=> $language->code] ) }}">
                    <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                    <span>{{$language->name}}</span>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="">
        <div class="">

            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('About') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="signinSrEmail">{{ translate('Footer Logo') }}</label>
                            <div class="input-group " data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="types[]" value="footer_logo">
                                <input type="hidden" name="footer_logo" class="selected-files" value="{{ get_setting('footer_logo') }}">
                            </div>
                            <div class="file-preview"></div>
                        </div>
                        <div class="form-group">
                            <label>{{ translate('About description') }}</label>
                            <input type="hidden" name="types[][{{ $lang }}]" value="about_us_description">
                            <textarea class="aiz-text-editor form-control" name="about_us_description" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">
                                @php echo get_setting('about_us_description', null, $lang); @endphp
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label>{{ translate('Social Links') }}</label>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-facebook-f"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="facebook_link">
                                <input type="text" class="form-control" placeholder="http://" name="facebook_link" value="{{ get_setting('facebook_link')}}">
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-twitter"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="twitter_link">
                                <input type="text" class="form-control" placeholder="http://" name="twitter_link" value="{{ get_setting('twitter_link')}}">
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-instagram"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="instagram_link">
                                <input type="text" class="form-control" placeholder="http://" name="instagram_link" value="{{ get_setting('instagram_link')}}">
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-youtube"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="youtube_link">
                                <input type="text" class="form-control" placeholder="http://" name="youtube_link" value="{{ get_setting('youtube_link')}}">
                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="lab la-linkedin-in"></i></span>
                                </div>
                                <input type="hidden" name="types[]" value="linkedin_link">
                                <input type="text" class="form-control" placeholder="http://" name="linkedin_link" value="{{ get_setting('linkedin_link')}}">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="">Terms & Conditions</label>
                            <div class="input-group form-group">

                                <input type="hidden" name="types[]" value="terms_conditions">
                                <input type="text" class="form-control" placeholder="http://" name="terms_conditions" value="{{ get_setting('terms_conditions')}}">
                            </div>
                            <label for="">Return Policy</label>
                            <div class="input-group form-group">

                                <input type="hidden" name="types[]" value="return_policy">
                                <input type="text" class="form-control" placeholder="http://" name="return_policy" value="{{ get_setting('return_policy')}}">
                            </div>
                            <label for="">Support Policy</label>

                            <div class="input-group form-group">
                                <input type="hidden" name="types[]" value="support_policy">
                                <input type="text" class="form-control" placeholder="http://" name="support_policy" value="{{ get_setting('support_policy')}}">
                            </div>
                            <label for="">Privacy Plicy</label>

                            <div class="input-group form-group">
                                <input type="hidden" name="types[]" value="privacy_policy">
                                <input type="text" class="form-control" placeholder="http://" name="privacy_policy" value="{{ get_setting('privacy_policy')}}">
                            </div>

                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Left Menu Widget + payment image') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                          <div class="form-group">
                              <label>{{ translate('Payment Methods') }}</label>
                              <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                  <div class="input-group-prepend">
                                      <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                  </div>
                                  <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                  <input type="hidden" name="types[]" value="payment_method_images">
                                  <input type="hidden" name="payment_method_images" class="selected-files" value="{{ get_setting('payment_method_images')}}">
                              </div>
                              <div class="file-preview box sm">
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
                    <h6 class="mb-0">{{ translate('Contact Info Widget') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Contact address') }} ({{ translate('Translatable') }})</label>
                            <input type="hidden" name="types[][{{ $lang }}]" value="contact_address">
                            <input type="text" class="form-control" placeholder="{{ translate('Address') }}" name="contact_address" value="{{ get_setting('contact_address',null,$lang) }}">
                        </div>
                        <div class="form-group">
                            <label>{{ translate('Contact phone') }}</label>
                            <input type="hidden" name="types[]" value="contact_phone">
                            <input type="text" class="form-control" placeholder="{{ translate('Phone') }}" name="contact_phone" value="{{ get_setting('contact_phone') }}">
                        </div>
                        <div class="form-group">
                            <label>{{ translate('Contact email') }}</label>
                            <input type="hidden" name="types[]" value="contact_email">
                            <input type="text" class="form-control" placeholder="{{ translate('Email') }}" name="contact_email" value="{{ get_setting('contact_email') }}">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card ">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Quick Links ') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            {{-- <label>{{ translate('Title') }} ({{ translate('Translatable') }})</label> --}}
                            <input type="hidden" name="types[][{{ $lang }}]" value="widget_two">
                            {{-- <input type="text" class="form-control" placeholder="Widget title" name="widget_one" value="{{ get_setting('widget_one',null,$lang) }}"> --}}
                        </div>
                        <div class="form-group">
                            <label>{{ translate('Links') }} - ({{ translate('Translatable') }} {{ translate('Label') }})</label>
                            <div class="w3-links-target">
                                <input type="hidden" name="types[][{{ $lang }}]" value="widget_one_labels">
                                <input type="hidden" name="types[]" value="widget_one_links">
                                @if (get_setting('widget_one_labels',null,$lang) != null)
                                    @foreach (json_decode(get_setting('widget_one_labels',null,$lang), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="{{translate('Label')}}" name="widget_one_labels[]" value="{{ $value }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="http://" name="widget_one_links[]" value="{{ json_decode(get_setting('widget_one_links'), true)[$key] }}">
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
                                data-content='<div class="row gutters-5">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="{{translate('Label')}}" name="widget_one_labels[]">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="http://" name="widget_one_links[]">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>'
                                data-target=".w3-links-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card ">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Policy Links') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            {{-- <label>{{ translate('Title') }}</label>
                            <input type="hidden" name="types[]" value="widget_two"> --}}
                            {{-- <input type="text" class="form-control" placeholder="Widget title" name="widget_two" value="{{ get_setting('widget_two') }}"> --}}
                        </div>
                        <div class="form-group">
                            <label>{{ translate('Links') }}</label>
                            <div class="w2-links-target">
                                <input type="hidden" name="types[]" value="widget_two_labels">
                                <input type="hidden" name="types[]" value="widget_two_links">
                                @if (get_setting('widget_two_labels') != null)
                                    @foreach (json_decode(App\BusinessSetting::where('type', 'widget_two_labels')->first()->value, true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Label" name="widget_two_labels[]" value="{{ $value }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="http://" name="widget_two_links[]" value="{{ json_decode(App\BusinessSetting::where('type', 'widget_two_links')->first()->value, true)[$key] }}">
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
                                data-content='<div class="row gutters-5">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Label" name="widget_two_labels[]">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="http://" name="widget_two_links[]">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                            <i class="las la-times"></i>
                                        </button>
                                    </div>
                                </div>'
                                data-target=".w2-links-target">
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
                    <h6 class="fw-600 mb-0">{{ translate('Copyright Widget') }}</h6>
                </div>
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   <div class="card-body">
                        <div class="form-group">
                            <label>{{ translate('Copyright Text') }}</label>
                            <input type="hidden" name="types[][{{ $lang }}]" value="frontend_copyright_text">
                            <textarea class="aiz-text-editor form-control" name="frontend_copyright_text" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">@php echo get_setting('frontend_copyright_text', null, $lang); @endphp</textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <h6 class="fw-600 mb-0">{{ translate('news Letter text') }}</h6>
                </div>
                <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   <div class="card-body">
                        <div class="form-group">

                            <input type="hidden" name="types[][{{ $lang }}]" value="news_letter_text">
                            <textarea class="aiz-text-editor form-control" name="news_letter_text" data-buttons='[["font", ["bold", "underline", "italic"]],["insert", ["link"]],["view", ["undo","redo"]]]' placeholder="Type.." data-min-height="150">@php echo get_setting('news_letter_text', null, $lang); @endphp</textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

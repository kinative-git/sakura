<div class="aiz-card-box  has-transition hov-shadow-md rounded border ">
<div class="d-flex justify-content-between align-items-center py-3 px-4">
    <div class="">

        <a href="{{ route('product', $product->slug) }}" class="d-block">
            <img
                class="img-fit lazyload mx-auto"
                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                alt="{{  $product->getTranslation('name')  }}"
               style="height: 5.5rem;width:100%;"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
            >
        </a>
    </div>
    <div class="px-md-3 px-2  text-left">
        <div class="fw-600 fs-12 lh-1-4 ">
            <a href="{{ route('product', $product->slug) }}" class="d-block text-reset text-truncate-2" style="height:35px;">{{  $product->getTranslation('name')  }}</a>
        </div>
    </div>
</div>

</div>

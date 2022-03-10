@extends('layout')
@section('title', 'Home')
@section('main')
<div class="container mt-4 mb-4">

  <div class="row">
    <div class="col-12 col-md-4 col-lg-3">
      <div class="card category-menu">
        <div class="card-header bg-primary text-white fw-bold">
          CATEGORIES
        </div>
        <div class="card-body">
          <ul>
            @include('main.menu.category-menu')
          </ul>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-8 col-lg-9 mt-4 mt-md-0">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          @foreach ($sliderImages as $sliderImg)
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $loop->index }}"
            class="@if($loop->index === 0) active @endif" aria-current="true" aria-label="Slide {{ $loop->index + 1 }}"></button>
          @endforeach
        </div>
        <div class="carousel-inner">
          @foreach ($sliderImages as $sliderImg)
          <div class="carousel-item @if($loop->index === 0) active @endif">
            <img src="{{ asset('storage/images/banners/'.$sliderImg->image) }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>{{ $sliderImg->title }}</h5>
              <p>{{ $sliderImg->subtext }}</p>
            </div>
          </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>

  <div class="card mt-4 border-0">
    <div class="card-body">
      <div class="row mb-2">
        <h4 class="col-6">Sales</h4>
        <div class="col-6 text-end">
          <a href="#" class="td-none font-2">See All</a>
        </div>
      </div>
      <div class="row">
        @foreach ($sales as $saleProduct)
        <div class="col-6 col-md-4 col-lg-3 mb-4">
          <div class="card product-card" id="product__{{ $saleProduct->id }}" data-product>
            <div class="card-body p-1">
              <div class="sale-percentage">
                {{ ceil(($saleProduct->price - $saleProduct->discounted_price) * 100 / $saleProduct->price) }}% OFF
              </div>
              <img src="{{ asset('img/no-image.png') }}" alt="Product image" data-product-image>
              <div class="product-card-title" title="{{ $saleProduct->name }}" data-product-title>
                {{ $saleProduct->name }}
              </div>
              <div class="product-card-unit" data-product-unit>{{ $saleProduct->unit }}</div>
              <div class="product-card-price">
                @if($saleProduct->discounted_price)
                <span class="sale" data-product-price>৳ {{ $saleProduct->price }}</span>
                <span data-product-discount-price>৳ {{ $saleProduct->discounted_price }}</span>
                @else
                <span data-product-price>৳ {{ $saleProduct->price }}</span>
                @endif
              </div>
            </div>
            <div class="product-card-footer" data-product-footer>
              <button class="btn add-to-cart-btn" data-add-to-cart>Add to Cart</button>
              <div class="product-card-tools">
                <button class="product-tool-btn" data-cart-item-decrease>
                  <i class="fa-solid fa-angle-left"></i>
                </button>
                <span class="me-1 ms-1" data-product-quantity>1</span>
                <button class="product-tool-btn" data-cart-item-increase>
                  <i class="fa-solid fa-angle-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

</div>

@endsection
@section('pageScripts')
<script>

</script>
@endsection
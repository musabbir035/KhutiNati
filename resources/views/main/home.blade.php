@extends('layout')
@section('title', 'Home')
@section('main')
<div class="container mt-4">
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
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('img/carousel.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>First slide label</h5>
              <p>Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('img/carousel.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Second slide label</h5>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ asset('img/carousel.jpg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Third slide label</h5>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div>
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

  <div class="row mt-4">
    <h4>Sales</h4>
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

    <div class="row mt-4">
      {{-- <h4>Popular Categories</h4>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="card border-radius-0 shadow-none category-card">
          <img src="{{ $categories->find(1)->image }}" alt="">
          <div class="title">
            {{ $categories->find(1)->name }}
          </div>
        </div>
      </div> --}}
    </div>
  </div>

  @endsection
@extends('layout')
@section('title', 'Home')
@section('main')
<div class="container">
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
          <h5>First slide</h5>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid, hic.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/carousel.jpg') }}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Second slide</h5>
          <p>Lorem ipsum dolor sit amet consectetur.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('img/carousel.jpg') }}" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Third slide</h5>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nemo veritatis harum in!.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="row mt-4">
    <h4>Popular Categories</h4>
    <div class="col-6 col-md-4 col-lg-3">
      <div class="card border-radius-0 shadow-none category-card">
        <img src="{{ $categories->find(1)->image }}" alt="">
        <div class="title">
          {{ $categories->find(1)->name }}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
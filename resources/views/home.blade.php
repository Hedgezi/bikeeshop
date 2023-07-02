@extends('layouts.app')

@section('content')
    <div class="col-12 text-center mt-5">
        <h1>Home</h1>
    </div>

    <div id="carouselFirstControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach(\App\Models\Product::take(3)->get() as $product)
                <div class="carousel-item @if($loop->index == 0) active @endif w-75">
                    <img class="d-block w-100" src="@if(count($product->images) != 0){{ asset('storage/' . $product->images[0]->path) }} @else {{ asset('storage/' . 'blank.png') }} @endif" alt="{{ $product->name }}">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselFirstControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselFirstControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

@endsection

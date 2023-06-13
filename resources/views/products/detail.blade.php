@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                @if($images)
                    @foreach($images as $image)
                        <img src="{{ Storage::url($image['path']) }}" class="w-100">
                    @endforeach
                @endif
            </div>
            <div class="col-8">
                <div class="row">
                    <h1>{{ $product->name }}</h1>
                </div>
                <div class="row">
                    <h3></h3>
                </div>
                <div class="row">
                    <h3>{{ $product->description }}</h3>
                </div>
                <div class="row">
                    <form action="/add-to-cart" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

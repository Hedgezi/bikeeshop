@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-4">
                    <div class="card m-2">
                        <div class="card-header">
                            <a href="/product/{{ $product->id }}">{{ $product->name }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <a href="/product/{{ $product->id }}">
                                    <img src="{{ Storage::url($product->images[0]['path'] ?? '') }}" alt="" class="w-100">
                                </a>
                            </div>
                            <div class="row">
                                <h5>{{ $product->description }}</h5>
                            </div>
                            <div class="row">
                                <h3>{{ $product->price }}</h3>
                            </div>
{{--                            <div class="row">--}}
{{--                                <form action="/add-to-cart" method="POST">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="product_id" value="{{ $product->id }}">--}}
{{--                                    <button type="submit" class="btn btn-primary">Add to Cart</button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
@endsection

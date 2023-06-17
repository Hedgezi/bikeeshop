@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <a href="/product/{{ $product->id }}">{{ $product->name }}</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <img src="{{ Storage::url($product->image) }}" class="w-100">
                            </div>
                            <div class="row">
                                <h3>{{ $product->description }}</h3>
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

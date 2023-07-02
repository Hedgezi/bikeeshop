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
                    <h3>{{ $product->description }}</h3>
                </div>
                <form action="/add-to-cart" method="POST">
                    <div class="row mt-2 mb-3">
                        @csrf
                        <select class="form-select" name="variant_id">
                            @if($product->variants)
                                @foreach($product->variants as $variant)
                                    <option value="{{ $variant->id }}">{{ $variant->price }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="row">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    @if($user->cart->items)
        @foreach($user->cart->items as $item)
            @php
                $product = $item->product;
                $variant = $item->variant;
            @endphp
            <div class="row">
                <div class="col-4">
                    @if($product->images)
                        @foreach($product->images as $image)
                            <img src="{{ Storage::url($image['path']) }}" class="w-100">
                        @endforeach
                    @endif
                </div>
                <div class="col-4">
                    <div class="row">
                        <h1>{{ $product->name }}</h1>
                    </div>
                    <div class="row">
                        <h4>{{ $product->description }}</h4>
                    </div>
                    <ul>
                    @foreach($variant->attributes as $attribute)
                        <div class="row">
                            <li><h5><i>{{ $attribute->name }}: {{ \App\Models\Value::where('variant_id', $variant->id)->where('attribute_id', $attribute->id)->first()->value }}</i></h5></li>
                        </div>
                    @endforeach
                    </ul>
                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-9">
                            <h3 id="price{{ $loop->index }}">{{ $item->price }} -.</h3>
{{--                            <h3> -.</h3>--}}
                        </div>
                        <input type="number" name="quantity" id="quantity{{ $loop->index }}" value="{{ $item->quantity }}" class="h-50 text-center col" min="1">
                        <div class="col">
                            <form action="/delete-from-cart" method="POST">
                                @csrf
                                <input type="hidden" name="variant_id" value="{{ $variant->id }}">
                                <button type="submit" class="btn btn-danger m-1 w-50">-</button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    @endif
    <div class="row">
        <div class="col">
            <h3 id="total">Total: {{ $user->cart->total() }} -.</h3>
        </div>
        <div class="col-2">
            <form action="/checkout" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>
    </div>
    <script>
        let quantities = [];
        function calculateTotal(index) {
            let quantityInput = document.getElementById("quantity" + index);
            let price = document.getElementById("price" + index);
            let total = document.getElementById("total");
            let totalValue = parseFloat(total.innerText.split(" ")[1]);
            let priceValue = parseFloat(price.innerText.split(" ")[0].replace(",", "."));
            let quantityValue = parseFloat(quantityInput.value);
            if (quantityValue < quantities[index]) {
                totalValue -= priceValue;
            } else {
                totalValue += priceValue;
            }
            quantities[index] = quantityValue;
            total.innerText = "Total: " + totalValue.toFixed(2) + " -.";
        }

        document.addEventListener("DOMContentLoaded", function() {
            @for($i = 0; $i < count($user->cart->items); $i++)
                let quantityInput{{ $i }} = document.getElementById("quantity{{ $i }}");
                quantities.push(quantityInput{{ $i }}.value);
                quantityInput{{ $i }}.addEventListener("input", function (event) {
                    event.preventDefault();
                    calculateTotal({{ $i }});
                });
            @endfor
        });
    </script>
@endsection

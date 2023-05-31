@extends("layouts.app")

@section("content")
    <form name="createProduct" method="POST" @isset($product) action="/admin/product/{{ $product->id }}" @else action="/admin/product" @endisset>
        @csrf
        <div class="container">
            <div class="row">
                <input class="col-9 m-3" type="text" placeholder="Name" name="name" @isset($product) value="{{ $product->name }}" @endisset required>
{{--                <input class="col m-3" type="text" placeholder="Price" name="price" @isset($product) value="{{ $product->price }}" @endisset required>--}}
            </div>
            <div class="row">
                <input class="col m-3" type="text" placeholder="Description" name="description" @isset($product) value="{{ $product->description }}" @endisset required>
            </div>
            <div class="row">
                <select name="brand_id" class="col m-3">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @isset($product) @if($product->brand_id == $brand->id)
                            selected
                            @endif @endisset>{{ $brand->name }}</option>
                    @endforeach
                </select>
                <select name="country_id" class="col m-3">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" @isset($product) @if($product->country_id == $country->id)
                            selected
                            @endif @endisset>{{ $country->name }}</option>
                    @endforeach
                </select>
                <select name="type_id" class="col m-3">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" @isset($product) @if($product->type_id == $type->id)
                            selected
                        @endif @endisset>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input class="btn btn-primary p-2 m-2" type="submit" value="Update">
    </form>
@endsection

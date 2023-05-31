@extends("layouts.app")

@section("content")
<form name="createProduct" method="POST" action="/admin/product">
    @csrf
    <div class="container">
        <div class="row">
            <input class="col-9 m-3" type="text" placeholder="Name" name="name" id="name" required>
            <input class="col m-3" type="text" placeholder="Price" name="price" required>
        </div>
        <div class="row">
            <input class="col m-3" type="text" placeholder="Description" name="description" required>
        </div>
        <div class="row">
            <select name="brand_id" class="col m-3">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            <select name="country_id" class="col m-3">
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            <select name="type_id" class="col m-3">
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
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
    <input class="btn btn-primary p-2 m-2" type="submit" value="Create">
</form>
@endsection

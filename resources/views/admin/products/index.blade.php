@extends('layouts.app')

@section('content')
    <a class="btn btn-light m-lg-3" href="/admin/product/create">+</a>
    <br/>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>
            <th scope="row">{{ $product->id }}</th>
            <td>{{ $product->name }}</td>
{{--            <td>{{ $product->price }}</td>--}}
            <td>{{ $product->description }}</td>
            <td><a class="btn btn-secondary" href="/admin/product/{{ $product->id }}/edit">Edit</a></td>
            <td><a class="btn btn-danger" href="/admin/product/{{ $product->id }}/delete">Delete</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection

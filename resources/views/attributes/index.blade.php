@extends('layouts.app')

@section('content')
    <a class="btn btn-light m-lg-3" href="/admin/attribute/create">+</a>
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
        @foreach($attributes as $attribute)
        <tr>
            <th scope="row">{{ $attribute->id }}</th>
            <td>{{ $attribute->name }}</td>
            <td>{{ $attribute->description }}</td>
            <td><a class="btn btn-secondary" href="/admin/attribute/{{ $attribute->id }}/edit">Edit</a></td>
            <td><a class="btn btn-danger" href="/admin/attribute/{{ $attribute->id }}/delete">Delete</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $attributes->links() }}
@endsection

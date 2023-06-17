@extends('layouts.app')

@section('content')
    <a class="btn btn-light m-lg-3" href="/admin/user/create">+</a>
    <br/>
    <table class="table table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Created at</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at }}</td>
            <td><a class="btn btn-secondary" href="/admin/user/{{ $user->id }}/edit">Edit</a></td>
            <td><a class="btn btn-danger" href="/admin/user/{{ $user->id }}/delete">Delete</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection

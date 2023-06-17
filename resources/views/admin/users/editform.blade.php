@extends("layouts.app")

@section("content")
    <form name="createUser" method="POST" action="/admin/user">
        @csrf
        <div class="container">
            <div class="row">
                <input class="col m-3" type="text" placeholder="Name" name="name" id="name" value="{{ $user->name }}" required>
                <input class="col m-3" type="text" placeholder="E-mail" name="email" value="{{ $user->email }}" required>
                <input class="col m-3" type="text" placeholder="Password" name="password" required>
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

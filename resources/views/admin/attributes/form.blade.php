@extends("layouts.app")

@section("content")
    <form name="createAttribute" method="POST" @isset($attribute) action="/admin/attribute/{{ $attribute->id }}" @else action="/admin/attribute" @endisset>
        @csrf
        <div class="container">
            <div class="row">
                <label>
                    <input class="col-9 m-3" type="text" placeholder="Name" name="name" @isset($attribute) value="{{ $attribute->name }}" @endisset required>
                </label>
            </div>
            <div class="row">
                <label>
                    <input class="col-9 m-3" type="text" placeholder="Description" name="description" @isset($attribute) value="{{ $attribute->description }}" @endisset>
                </label>
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

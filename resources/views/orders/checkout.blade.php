@extends('layouts.app')

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Checkout</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h1>Shipping Address</h1>
                <form action="/checkout" method="POST">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" name="name" id="name" placeholder="Name:" class="form-control" required>
                        <label for="name" class="form-label">Name:</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" name="street" id="street" placeholder="Street:" class="form-control" required>
                        <label for="street" class="form-label">Street:</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" name="city" id="city" placeholder="City:" class="form-control" required>
                        <label for="city" class="form-label">City:</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" name="zip" id="zip" placeholder="Zip:" class="form-control" required>
                        <label for="zip" class="form-label">Zip:</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" name="country" id="country" placeholder="Country:" class="form-control" required>
                        <label for="country" class="form-label">Country:</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" name="phone" id="phone" placeholder="Phone:" class="form-control" required>
                        <label for="phone" class="form-label">Phone:</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="email" name="email" id="email" placeholder="E-Mail:" class="form-control" required>
                        <label for="email" class="form-label">E-Mail:</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Buy</button>
                </form>
            </div>
@endsection

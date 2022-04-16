@extends('layouts.users')

@section('title')
Account Settings
@endsection

@section('contents')

<div class="card">
    <div class="card-body">

        <h4 id="rw-fl-row">Accout Settings</h4>
        <p class="subtitle margin-bottom-20">Update Information</p>

        @include('includes.alerts')

        <form method="post" action="{{ route('user.update-account') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Upload Profile Image</label>
                <input type="file" class="form-control" name="image_id">
            </div>

            <div class="form-group">
                <label>First Name *</label>
                <input type="text" class="form-control" name="fname" value="{{ Auth::user()->fname }}" required>
            </div>

            <div class="form-group">
                <label>Last Name *</label>
                <input type="text" class="form-control" name="lname" value="{{ Auth::user()->lname }}" required>
            </div>

            <div class="form-group">
                <label>Mobile Number *</label>
                <input type="number" class="form-control" name="mobile" value="{{ Auth::user()->mobile }}" required>
            </div>

            <div class="form-group">
                <label>Address *</label>
                <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required>
            </div>

            <div class="form-group">
                <label>Country *</label>
                <input type="text" class="form-control" name="country" value="{{ Auth::user()->country }}" required>
            </div>

            <div class="form-group">
                <label>State *</label>
                <input type="text" class="form-control" name="state" value="{{ Auth::user()->state }}" required>
            </div>

            <div class="form-group">
                <label>Password *</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="form-group">
                <label>Pin *</label>
                <input type="password" class="form-control" name="pin" maxlength="4" value="{{ Auth::user()->pin }}" required>
            </div>

            <button type="submit" class="btn btn-secondary">Update</button>
        </form>

    </div>
</div>

@endsection
